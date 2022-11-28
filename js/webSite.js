//Metamask and connection Functions

const connectMetamask = async () => {
    var errorNet=1;
    $('#metaMaskStatusMobile').text('Connect');
    $('#metaMaskStatus').html('<i class="zmdi zmdi-circle"></i> Connect');
    if (typeof window.ethereum !== 'undefined') {
        var accounts = await ethereum.request({ method: 'eth_requestAccounts' });
        var tipper_addresses = accounts;
        const chainId = await ethereum.request({ method: 'eth_chainId' });
        if (chainId!="0x13881") {
            swichNetwork(80001);
        }else{
            web3 = new Web3(window.ethereum);
            var nameProvider = 'Mumbai TestNet';
            var nameProviderShort = 'Mumbai TestNet';
            $('#metamaskChainName').html(nameProvider);
            $('#metamaskChainNameMobile').html(nameProviderShort);
            getArtWorkMinted();
            getGoldCollectionMinted();
            getgoldNFTCollectionMinted();
            errorNet=0;
        }
        $('#metamaskAccountName').html(tipper_addresses[0]);
        $('#metamaskAccountNameMobile').html('Address: '+tipper_addresses[0]);

        $('#metaMaskStatusMobile').text('Connected');
        $('#metaMaskStatus').html('<i class="zmdi zmdi-circle-o"></i> Connected');
    }else{
        alert("Please Install Metamask");
        $('#metaMaskStatusMobile').text('Install Metamask');
        $('#metaMaskStatus').html('<i class="zmdi zmdi-notifications-active"></i> Install Metamask');
    }
}

const getAccounts = async () => {
    if (typeof window.ethereum !== 'undefined') {
        var accounts = await ethereum.request({ method: 'eth_requestAccounts' });
        return accounts;
    }
}

const getChainId = async () => {
    if (typeof window.ethereum !== 'undefined') {
        var actualChainId = await ethereum.request({ method: 'eth_chainId' });
        return actualChainId;
    }
}

const swichNetwork = async (chainId) => {
      try {
        await web3.currentProvider.request({
          method: 'wallet_switchEthereumChain',
            params: [{ chainId: Web3.utils.toHex(chainId) }],
          });
      } catch (switchError) {
        // This error code indicates that the chain has not been added to MetaMask.
        if (switchError.code === 4902) {
          alert('add this chain id: '+chainId)
        }
      }
}


ethereum.on('accountsChanged', function (accounts) {
    $('#metamaskAccountName').html(accounts[0]);
});

ethereum.on('chainChanged', function (_chainId) {
    
    if (_chainId!="0x13881") {
        alert('Chain changed!');
        swichNetwork(80001);
    }
    

})
ethereum.on('disconnect',connectMetamask);
//End Metamask and connection Functions



function NftArtWork_ViewImage(nftId) {
    $('#artWorkImageDiv').html("<div align='center'><img src='NFT/images/"+nftId+".jpg'></div>");
    $('#viewArtWorkImageLabel').text('Art Work NFT #'+nftId);
    $('#viewArtWorkImage').modal('show');
}

function NftArtWork_ViewGold(nftId) {
    goldTokenInArtWork(nftId);
    $('#viewGoldinArtWorkLabel').text('View Gold In Art Work #'+nftId);
    $('#viewGoldinArtWork').modal('show');
}

function NftArtWork_AddGold(nftId) {
    getMyGoldTokensSmall(nftId);
    $('#addGoldToArtWorkNFT').modal('show');

}

async function MoveTokenToAnotherWallet(nftId) {
    $('#_tokenId').val(nftId);
    $('#moveTokenModal').modal('show');
}


async function NftArtWork_Transfer(nftId) {
    accounts = await getAccounts();
    let Allowance = await isAllowanceOnArtWork();
    let _transferCost = await _calculateTransferCost(nftId);
    let _usdcBalance = await usdcBalance(); 
    
    _usdcBalance = _usdcBalance/(1e18);
    _usdcBalance = parseFloat(_usdcBalance).toFixed(2);
    Allowance = Allowance/(1e18);
    Allowance = parseFloat(Allowance).toFixed(0);
    if (parseFloat(_usdcBalance).toFixed(0)<parseFloat(_transferCost).toFixed(0)) {
        $('#showFooter').html('<p align="center"><font color="red">You don\'t have funds in your wallets to make this transaction. This transaction will Fail.</font></p>')
    }
    console.log('Allowance:'+Allowance);
    console.log('Transfer Cost:'+_transferCost);
    if (_transferCost>Allowance) {
        $('#showFooter').html('<p align="center"><font color="red">Invalid Allowance. This transaction will Fail.</font></p>')
    }
    $('#_nftId').val(nftId);
    $('#artWorkTransferCost').val('$'+_transferCost+' USDC');
    $('#usdcBalanceAddress').val('$'+_usdcBalance+' USDC');
    $('#artWorkAddress').val(accounts[0]);
    $('#transferArtWorkOwner').modal('show');
}

async function NftArtWork_ChangePrice(nftId) {
    $('#artWorkActualPrice').val('');
    $('#artWorkActualPriceGwei').val('');
    $('#usdcBalanceAddressinChange').val('');
    $('#artWorkMinPriceToChange').val('');
    $('#artWorkChangePriceCost').val('');
    $('#artWorkNewPrice').val('');
    tokenUri = await getArtWorkNFTDetails(nftId);
    let _artWorkActualPrice = tokenUri.attributes[2].value;
    _artWorkActualPriceGwei = _artWorkActualPrice;
    _artWorkActualPrice = _artWorkActualPrice/(1e18);
    _usdcBalance = await usdcBalance();
    console.log(_usdcBalance)
    _usdcBalance = _usdcBalance/(1e18);
    _usdcBalance = parseFloat(_usdcBalance).toFixed(2);
    $('#artWorkActualPrice').val('$'+_artWorkActualPrice+' USDC');
    $('#artWorkActualPriceGwei').val(_artWorkActualPriceGwei);
    $('#usdcBalanceAddressinChange').val('$'+_usdcBalance+' USDC');
    $('#_nftIdChangePrice').val(nftId);
    $('#changeArtWorkNftPrice').modal('show');
}

$('#artWorkNewPrice').keyup(async function(){
    _typeInPrice = $('#artWorkNewPrice').val();
    _nftId = $('#_nftIdChangePrice').val();
    _goldSupportValue = await _detailGoldSupport(_nftId);
    _minPriceToChange = _goldSupportValue*2;
    _minPriceTochange = parseFloat(_minPriceToChange).toFixed(0);

    $('#artWorkMinPriceToChange').val('$'+_goldSupportValue*2+' USDC');
    console.log(_goldSupportValue)
    let _checkPrice = parseFloat(_typeInPrice).toFixed(0); 
    if (_checkPrice=="NaN") {
        $('#artWorkNewPrice').val(0);
    }else{
        let _artWorkActualPriceGwei = $('#artWorkActualPriceGwei').val();
        let _artWorkNewPrice = $('#artWorkNewPrice').val();
        _actualPriceToChange = _artWorkNewPrice;
        //_artWorkNewPrice = _artWorkNewPrice*(1e18);
        _changePriceCost = await _calculateRoyaltiesToChangePrice(_nftId,_artWorkNewPrice);
        
        if (_actualPriceToChange<_minPriceToChange) {
            $('#artWorkNewPrice').addClass("is-invalid form-control")
        }else{
            $('#artWorkNewPrice').removeClass("is-invalid form-control")
            $('#artWorkNewPrice').addClass("form-control")
        }
        $('#artWorkChangePriceCost').val('$'+_changePriceCost+' USDC');
    }
});

function NftArtWork_EditMiniSite(_tokenId) {
    var PATH_IMG = 'http://45.55.243.107/web3/artWork/NFT/images/extraData/';
    $.ajax({
        url: 'includes/webServices/getInfoFromExtraDataToken.php',
        method: 'GET',
        data: {tokenId: _tokenId},
        success: function(result) {
            data = JSON.parse(result);
            console.log(data);
            $('#authorName').val(data.authorName);
            $('#title').val(data.title);
            $('#place').val(data.place);
            $('#year').val(data.year);
            $('#collection').val(data.collection);
            $('#width').val(data.width);
            $('#heigth').val(data.heigth);
            $('#units').val(data.units);
            $('#inscription').val(data.inscription);
            $('#technique').val(data.technique);
            $('#conservation').val(data.conservation);
            $('#category').val(data.category);
            $('#additionalNotes').val(data.additionalNotes);
            var frontImage = data.frontImage;
            var reverseImage = data.reverseImage;
            var inscriptionImage = data.inscriptionImage;
            var signImage = data.signImage;
            $('#frontImageDiv').html('');
            $('#reverseImageDiv').html('');
            $('#inscriptionImageDiv').html('');
            $('#signImageDiv').html('');
            $('#certificate1').val(data.certificate1);
            $('#certificate2').val(data.certificate2);
            $('#certificate3').val(data.certificate3);
            $('#certificate4').val(data.certificate4);

            if (frontImage) {
                frontImageDiv = '<img src="'+PATH_IMG+frontImage+'" width="100" heigth="100">';
                $('#frontImageDiv').html(frontImageDiv);
                console.log(frontImageDiv);
            }
            if (reverseImage) {
                reverseImageDiv = '<img src="'+PATH_IMG+reverseImage+'" width="100" heigth="100">';
                $('#reverseImageDiv').html(reverseImageDiv);
            }
            if (inscriptionImage) {
                inscriptionImageDiv = '<img src="'+PATH_IMG+inscriptionImage+'" width="100" heigth="100">';
                $('#inscriptionImageDiv').html(inscriptionImageDiv);
            }
            if (signImage) {
                signImageDiv = '<img src="'+PATH_IMG+signImage+'" width="100" heigth="100">';
                $('#signImageDiv').html(signImageDiv);
            }
        }
    })
    $('#tokenIdEditWebsite').val(_tokenId);
    $('#tokenAdditionalInformation').modal('show');
}

$('#SendNftArtWork_EditMiniSite').click(function () {
    document.getElementById("tokenAdditionalInformationForm").submit();
})


//Gold Collections

function mintGoldNFT(_maxAllowed,_goldTokenId) {
    $('#goldTokenQty').attr({
        "max": _maxAllowed,
        "min": 1
    })
    $('#goldMintTokenId').val(_goldTokenId);
    $('#mintGoldNFT').modal('show');
}


//End Gold Collections

function increaseUSDC_GoldAllowance() {
    $('#increaseUSDC_GoldAllowance').modal('show');
};

//General
function reloadWeb(url) {
    window.location.href=url;
}

//on Load
window.onload = () => {
    $('#metaMaskStatusMobile').text('Connect');
    $('#metaMaskStatus').html('<i class="zmdi zmdi-circle"></i> Connect');
    
    connectMetamask();
}

//End on Load

