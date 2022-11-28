//Info Functions
const artWorkMinted = async () => {
    artWorkContractABI = artWorkABI();
    Mycontract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
    callContract = await Mycontract.methods.totalMint().call();
    return callContract;
}

const getArtWorkMinted = async () => {
    let qtyMinted = await artWorkMinted();
    $('#artWorkMinted').html(qtyMinted); 
}

const goldCollectionMinted = async () => {
    goldContractABI = goldABI();
    MyContract = new web3.eth.Contract(goldContractABI,goldContract);
    callContract = await MyContract.methods.showAvailbleGoldCollections().call();
    return callContract.length;
}

const getGoldCollectionMinted = async () => {
    let qtyMinted = await goldCollectionMinted();
    $('#goldCollectionMinted').html(qtyMinted);
}

const goldNFTCollectionMinted = async () => {
    goldContractABI = goldABI();
    MyContract = new web3.eth.Contract(goldContractABI,goldContract);
    callContract = await MyContract.methods.totalMint().call();
    return callContract;
}

const getgoldNFTCollectionMinted = async () => {
    let qtyMinted = await goldNFTCollectionMinted();
    $('#goldNFTCollectionMinted').html(qtyMinted);
}


//Allowance gold NFT / USDC
async function isAllowanceOnGold() {
    if (typeof window.ethereum !== 'undefined') {
        window.web3 = new Web3(window.ethereum);
        accounts = await getAccounts();
        usdcContractABI = usdcABI();
        MyContract = new web3.eth.Contract(usdcContractABI,usdcContract);
        callContract = await MyContract.methods.allowance(accounts[0],goldContract).call();
        console.log(callContract);
        return callContract;
    }
}

async function isAllowanceOnArtWork() {
    if (typeof window.ethereum !== 'undefined') {
        window.web3 = new Web3(window.ethereum);
        accounts = await getAccounts();
        usdcContractABI = usdcABI();
        MyContract = new web3.eth.Contract(usdcContractABI,usdcContract);
        callContract = await MyContract.methods.allowance(accounts[0],artWorkContract).call();
        console.log(callContract);
        return callContract;
    }
}


async function usdcBalance() {
    if (typeof window.ethereum !== 'undefined') {
        window.web3 = new Web3(window.ethereum);
        accounts = await getAccounts();
        usdcContractABI = usdcABI();
        MyContract = new web3.eth.Contract(usdcContractABI,usdcContract);
        callContract = await MyContract.methods.balanceOf(accounts[0]).call();
        console.log(callContract);
        return(callContract);
    }
}

async function sendTX_allowanceUSDGOLD() {
    //allowanceUSDCGOLD_Button 
    if (window.ethereum) {
        await window.ethereum.send('eth_requestAccounts');
        window.web3 = new Web3(window.ethereum);
        usdcContractABI = usdcABI();
        MyContract = new web3.eth.Contract(usdcContractABI,usdcContract);
        const amountToApprove = Web3.utils.toWei('100000','ether');
        const txHash = await MyContract.methods.approve(goldContract,amountToApprove).send({from: tipper_addresses[0]})
            .on('transactionHash', (hash) => {
                console.log('Processing...');
                $('#allowanceUSDCGOLD_Button').html('<center>Processing transacion... please wait</center>');
            })
            .then((receipt) => {
                console.log(receipt);
                $('#allowanceUSDCGOLD_Text').html('TX was confirmed\nGas used: '+receipt.cumulativeGasUsed);
                $('#allowanceUSDCGOLD_Button').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>');
                getGoldCollectionsDetail();
            })
            .catch((error) => {
                console.log(error);
                $('#allowanceUSDCGOLD_Text').html('<font color=red>'+error.message+'</font>');
            })
    }
}



async function sendTX_MintGOLD() {
    if (window.ethereum) {
        balanceOf = await getUSDCBalance();
        balanceOf = balanceOf/(1e18);
        balanceOf = parseFloat(balanceOf).toFixed(2);
        console.log('Balance:'+balanceOf);
        
        window.web3 = new Web3(window.ethereum);
        accounts = await getAccounts();
        goldContractABI = goldABI();
        MyContract = new web3.eth.Contract(goldContractABI,goldContract);
        let _goldTokenId = $('#goldMintTokenId').val();
        let _qty = $('#goldTokenQty').val();
        totalToPay = await getGoldPrice(_qty,_goldTokenId);
        totalToPay = totalToPay/(1e18);
        totalToPay = parseFloat(totalToPay).toFixed(2);
        if (parseFloat(totalToPay)>parseFloat(balanceOf)) {
            $('#errorForm').html('<p align="center"><font color=red>You can\'t complete this transaction.\nYou only have '+balanceOf+' USDC on your wallet</font></p>');
        }else{
            const txHash = await MyContract.methods.mint(accounts[0],_qty,_goldTokenId).send({from: accounts[0]})
                .on('transactionHash', (hash) => {
                    console.log('Processing...');
                    $('#MintGOLD_CancelButton').html('');
                    $('#MintGOLD_Button').html('<center>Processing transacion... please wait</center>');
                    $('#errorForm').html('');
                })
                .then((receipt) => {
                    console.log(receipt);
                    $('#MintGOLD_Text').html('Ready!\nYou bought '+_qty+' grs\n(tokenId: '+receipt.events.CreateGold.returnValues[0]+') of Gold\nFrom Collection Id: '+_goldTokenId);
                    $('#MintGOLD_Button').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>');
                    getGoldCollectionsDetail();
                })
                .catch((error) => {
                    console.log(error);
                    $('#errorForm').html('<p align="center"><font color=red>'+error.message+'</font></p>');
                    //$('#MintGOLD_Button').html('');
                    $('#MintGOLD_CancelButton').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>');
                })        
            }
    }
}

/*
async function sendTX_MintCCGOLD() {
    if (window.ethereum) {
        window.web3 = new Web3(window.ethereum);
        accounts = await getAccounts();
        goldContractABI = goldABI();
        MyContract = new web3.eth.Contract(goldContractABI,goldContract);
        let _goldTokenId = $('#goldMintTokenId').val();
        let _qty = $('#goldTokenQty').val();
        const txHash = await MyContract.methods.mintCC(accounts[0],_qty,_goldTokenId).send({from: accounts[0]})
            .on('transactionHash', (hash) => {
                console.log('Processing...');
                $('#MintGOLD_CancelButton').html('');
                $('#MintGOLD_Button').html('<center>Processing transacion... please wait</center>');
                $('#errorForm').html('');
            })
            .then((receipt) => {
                console.log(receipt);
                $('#MintGOLD_Text').html('Ready!\nYou bought '+_qty+' grs\n(tokenId: '+receipt.events.CreateGold.returnValues[0]+') of Gold\nFrom Collection Id: '+_goldTokenId);
                $('#MintGOLD_Button').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>');
                getGoldCollectionsDetail();
            })
            .catch((error) => {
                console.log(error);
                $('#errorForm').html('<font color=red>'+error.message+'</font>');
                //$('#MintGOLD_Button').html('');
                $('#MintGOLD_CancelButton').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>');
            })        
    }
}
*/

$('#goldTokenQty').keyup(async function() {
    let goldTokenQty = $('#goldTokenQty').val();
    if (goldTokenQty!="") {
        let goldMintTokenId = $('#goldMintTokenId').val();
        //goldMintPrice
        let goldMintPrice = await getGoldPrice(goldTokenQty,goldMintTokenId);
        goldMintPrice = goldMintPrice/(1e18);
        goldMintPrice = parseFloat(goldMintPrice).toFixed(2);
        $('#goldMintPrice').val(goldMintPrice);
    }else{
        $('#goldMintPrice').val(0);
    }
    
})

async function getGoldCurrentSupply(_goldTokenId) {
    if (window.ethereum) {
        window.web3 = new Web3(window.ethereum);
        goldContractABI = goldABI();
        MyContract = new web3.eth.Contract(goldContractABI,goldContract);
        callContract = await MyContract.methods.currentSupply(_goldCollectionId).call();
        return callContract; 
    }
}


async function getGoldPrice(_goldQty,_goldCollectionId) {
    if (window.ethereum) {
        window.web3 = new Web3(window.ethereum);
        goldContractABI = goldABI();
        MyContract = new web3.eth.Contract(goldContractABI,goldContract);
        callContract = await MyContract.methods.mintPrice(_goldQty,_goldCollectionId).call();
        return callContract[2]; 
    }
}
async function getUSDCBalance() {
    if (window.ethereum) {
        window.web3 = new Web3(window.ethereum);
        accounts =  await getAccounts();
        usdcContractABI = usdcABI();
        MyContract = new web3.eth.Contract(usdcContractABI,usdcContract);
        callContract = await MyContract.methods.balanceOf(accounts[0]).call();
        return callContract;
    }
}
//Gold Collections
async function getGoldCollectionsDetail() {
    if (window.ethereum) {
        window.web3 = new Web3(window.ethereum);
        goldContractABI = goldABI();
        MyContract = new web3.eth.Contract(goldContractABI,goldContract);
        callContract = await MyContract.methods.showAvailbleGoldCollections().call();
        let qty = callContract.length;
        let counter=0;
        innerHtml = '';
        const allowance = await isAllowanceOnGold();
        for (j=0; j<qty;j++) {
            MyContract = new web3.eth.Contract(goldContractABI,goldContract);
            const goldCollectionDetails = await MyContract.methods.GoldCollections(j).call();
            
            

            if (counter==0) innerHtml += '<div class="row">';

            innerHtml += '<div class="col-md-4">';
                innerHtml +='<div class="card">';
                innerHtml +='<div class="card-header">';
                innerHtml +='<strong class="card-title mb-3">'+goldCollectionDetails.name+'</strong>';
                    innerHtml +='</div>';
                    innerHtml +='<div class="card-body">';
                        innerHtml +='<div class="mx-auto d-block">';
                            innerHtml +='<img class="rounded-circle mx-auto d-block" src="images/gold.jpg" alt="Gold ingot">';
                            innerHtml +='<h5 class="text-sm-center mt-2 mb-1">Purity: '+(goldCollectionDetails.purity)/100+'%</h5>';
                            innerHtml +='<h5 class="text-sm-center mt-2 mb-1">Available: '+goldCollectionDetails.qtyAvailable+'</h5>';
                            innerHtml +='<h5 class="text-sm-center mt-2 mb-1">On Sale: '+goldCollectionDetails.onSale+'</h5>';
                        innerHtml +='</div>';
                        innerHtml +='<hr>';
                        innerHtml +='<div class="card-text text-sm-center">';
                        if (goldCollectionDetails.onSale==true && goldCollectionDetails.qtyAvailable>0) {
                            if (allowance > 50*(1e18)) { //allowance > $50
                                innerHtml +='<button type="button" class="btn btn-primary btn-sm" onClick="mintGoldNFT('+goldCollectionDetails.qtyAvailable+','+j+');">';
                                innerHtml +='<i class="fa fa-dot-circle-o"></i> Mint';
                                innerHtml +='</button>';
                            }else{
                                innerHtml +='<button type="button" class="btn btn-primary btn-sm" onClick="increaseUSDC_GoldAllowance();">';
                                innerHtml += '<i class="fa fa-dot-circle-o"></i> Increase Allowance';
                                innerHtml +='</button>';
                            }
                        }
                        
                        innerHtml +='</div>';
                    innerHtml +='</div>';
                innerHtml +='</div>';
            if (counter==0) innerHtml += '</div>';

            if (counter<=1) {
                counter++;
            }else{
                counter=0;
            }
            
        }
        $('#contentInnerHtml').html(innerHtml);
        connectMetamask();
    }
}

// My Gold
async function getMyGoldTokens() {
    let j=0;
    let callContract = '';
    if (window.ethereum) {
        window.web3 = new Web3(window.ethereum);
        accounts =  await getAccounts();
        console.log(tipper_addresses[0]);
        goldContractABI = goldABI();
        MyContract = new web3.eth.Contract(goldContractABI,goldContract);
        callContract = await MyContract.methods.walletOfOwner(accounts[0]).call();
        console.log(callContract);
        console.log(callContract.length);
        let innerHtml = '';
        
        for (j=0; j<callContract.length; j++) {
            _tokenId = callContract[j];
            console.log('Token ID:'+_tokenId);
            
            tokenURI = await MyContract.methods.tokenURI(_tokenId).call();
            tokenURI = tokenURI.replace('data:application/json;base64,','');
            tokenURI = atob(tokenURI);
            tokenURI = tokenURI;
            tokenURI=JSON.parse(tokenURI);
            const _tokenDate = new Date(tokenURI.attributes[0].value*1e3);
            
            innerHtml += '<tr class="tr-shadow">';
            innerHtml += '<td>'+_tokenId+'</td>';
            innerHtml += '<td>'+_tokenDate+'</td>';
            innerHtml += '<td>'+tokenURI.attributes[1].value+' grs</td>';
            innerHtml += '<td>$'+parseFloat(tokenURI.attributes[2].value/1e18).toFixed(2)+'</td>';
            innerHtml += '<td>'+tokenURI.attributes[3].value+'</td>';
            innerHtml += '<td>'+tokenURI.attributes[4].value+'%</td>';
            innerHtml += '<td>'+tokenURI.attributes[5].value+'</td>';
            innerHtml += '</tr>';
            innerHtml += '<tr class="spacer"></tr>';
            console.log('J VALUE:'+j);
            
        }
        let innerHtml2 = '';
        innerHtml2 += '<table class="table table-data2">';
        innerHtml2 += '<thead>';
        innerHtml2 += '<tr>';
        innerHtml2 += '<th>gold token Id</th>';
        innerHtml2 += '<th>Creation Date</th>';
        innerHtml2 += '<th>Weight</th>';
        innerHtml2 += '<th>Estimated Price (USD)</th>';
        innerHtml2 += '<th>Collection Id</th>';
        innerHtml2 += '<th>Purity</th>';
        innerHtml2 += '<th>Entire Collection</th>';
        innerHtml2 += '</tr>';
        innerHtml2 += '</thead>';
        innerHtml2 += '<tbody>';
        innerHtml2 += innerHtml;
        innerHtml2 += '</tbody>';
        innerHtml2 += '</table>';
        
        $('#myGoldDataTable').html(innerHtml2);
    }
}


async function getMyGoldTokensSmall(nftId) {
    let j=0;
    let callContract = '';
    if (window.ethereum) {
        window.web3 = new Web3(window.ethereum);
        accounts =  await getAccounts()
        console.log(accounts[0]);
        goldContractABI = goldABI();
        MyContract = new web3.eth.Contract(goldContractABI,goldContract);
        callContract = await MyContract.methods.walletOfOwner(accounts[0]).call();
        console.log(callContract);
        console.log(callContract.length);
        let innerHtml = '';
        
        for (j=0; j<callContract.length; j++) {
            _tokenId = callContract[j];
            console.log('Token ID:'+_tokenId);
            
            tokenURI = await MyContract.methods.tokenURI(_tokenId).call();
            tokenURI = tokenURI.replace('data:application/json;base64,','');
            tokenURI = atob(tokenURI);
            tokenURI = tokenURI;
            tokenURI=JSON.parse(tokenURI);
            const _tokenDate = new Date(tokenURI.attributes[0].value*1e3);
            
            innerHtml += '<tr class="tr-shadow">';
            innerHtml += '<td>'+_tokenId+'</td>';
            innerHtml += '<td>'+tokenURI.attributes[1].value+' grs</td>';
            innerHtml += '<td>$'+parseFloat(tokenURI.attributes[2].value/1e18).toFixed(2)+'</td>';
            innerHtml += '<td>'+tokenURI.attributes[3].value+'</td>';
            innerHtml += '<td>'+tokenURI.attributes[4].value+'%</td>';
            innerHtml += '<td><input type="checkbox" name="selectedGoldToken" value='+_tokenId+'> </td>'
            innerHtml += '</tr>';
            innerHtml += '<tr class="spacer"></tr>';
        }
        let innerHtml2 = '';
        innerHtml2 += '<input type="hidden" id="nftId" value="'+nftId+'">';
        innerHtml2 += '<table class="table table-data2">';
        innerHtml2 += '<thead>';
        innerHtml2 += '<tr>';
        innerHtml2 += '<th>gold token Id</th>';
        innerHtml2 += '<th>Weight</th>';
        innerHtml2 += '<th>Estimated Price (USD)</th>';
        innerHtml2 += '<th>Collection Id</th>';
        innerHtml2 += '<th>Purity</th>';
        innerHtml2 += '';
        innerHtml2 += '</tr>';
        innerHtml2 += '</thead>';
        innerHtml2 += '<tbody>';
        innerHtml2 += innerHtml;
        innerHtml2 += '</tbody>';
        innerHtml2 += '</table>';
        
        $('#addGoldToArtWorkNFTTable').html(innerHtml2);
    }
}

async function getArtWorkNFTDetails(tokenId) {
    artWorkContractABI = artWorkABI();
    Mycontract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
    tokenURI = await Mycontract.methods.tokenURI(tokenId).call();
    tokenURI = tokenURI.replace('data:application/json;base64,','');
    tokenURI = atob(tokenURI);
    tokenURI = tokenURI;
    tokenURI=JSON.parse(tokenURI);
    return tokenURI;
    
}
async function getOwnerFixed() {
    artWorkContractABI = artWorkABI();
    Mycontract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
    ownerFixed = await Mycontract.methods.ownerFIXED().call();
    return ownerFixed;
}

async function getNFTArtWork(pagNum) {
    let showNFTMin;
    let showNFTMax;
    let NFTData = '';
    let urlPages;
    let innerHtml = '';
    let innerHtml2 = '';
    

    if (window.ethereum) {
        
        window.web3 = new Web3(window.ethereum);
        var ownerFixed = await getOwnerFixed();
        ownerFixed = ownerFixed/(1e18);
        const totalNFTartWork = await artWorkMinted();
        const maxToShow = 20;
        if (totalNFTartWork>maxToShow) {
            showNFTMax = (pageNum*20)-1;
            showNFTMin = showNFTMax-19;
        }
        if (totalNFTartWork<maxToShow) {
            showNFTMax = totalNFTartWork;
            showNFTMin= 0;
        }
        
        let pages = totalNFTartWork/maxToShow;
        if (pages<=1) {
            urlPages = "<a href='listNFT.php?pageNum=1'> 1 </a>";
        }else{
            for (i=0; i<pages;i++) {
                urlPages += "<a href='listNFT.php?pageNum="+i+"'>"+i+"</a>";
            }
        }
        
        
        for (j=showNFTMin;j<showNFTMax;j++) {
            tokenURI = await getArtWorkNFTDetails(j);
            ownerOfPerm = await _ownerOf(j);
            if (ownerOfPerm=="1") {
                galleryControl='Yes';
            }else{
                galleryControl='No';
            }
            let _tokenDate = new Date(tokenURI.attributes[0].value*1e3);
            _tokenDate = _tokenDate.toISOString();
            let _jsonUrl = tokenURI.attributes[4].value;
            innerHtml += '<tr class="tr-shadow">';
            innerHtml += '<td>'+j+'</td>';
            innerHtml += '<td>'+tokenURI.description+'</td>';
            innerHtml += '<td>'+tokenURI.attributes[1].value+'</td>';
            innerHtml += '<td>'+_tokenDate+'</td>';
            innerHtml += '<td>$'+parseFloat(tokenURI.attributes[2].value/1e18).toFixed(2)+'</td>';
            innerHtml += '<td>$'+parseFloat(tokenURI.attributes[3].value/1e18).toFixed(2)+'</td>';
            innerHtml += '<td>'+galleryControl+'</td>'

            innerHtml += '<td><div class="table-data-feature" align="center">';

            innerHtml += '<button class="item" data-toggle="tooltip" data-placement="top" title="View Art Work Image">';
            innerHtml += '<a href="#" onClick="NftArtWork_ViewImage('+j+')";><i class="zmdi zmdi-image"></i></a>';
            innerHtml += '</button>';

            innerHtml += '<button class="item" data-toggle="tooltip" data-placement="top" title="View Gold">';
            innerHtml += '<a href="#" onClick="NftArtWork_ViewGold('+j+')";><i class="zmdi zmdi-balance-wallet"></i></a>';
            innerHtml += '</button>';

            if (ownerOfPerm==1) {
                innerHtml += '<button class="item" data-toggle="tooltip" data-placement="top" title="Remove Gold - Price $'+ownerFixed+'">';
                innerHtml += '<a href="#" onClick="NftArtWork_RemoveGold('+j+')";><i class="zmdi zmdi-assignment-returned"></i></a>';
                innerHtml += '</button>';
                
                innerHtml += '<button class="item" data-toggle="tooltip" data-placement="top" title="Add Gold">';
                innerHtml += '<a href="#" onClick="NftArtWork_AddGold('+j+')";><i class="zmdi zmdi-assignment"></i></a>';
                innerHtml += '</button>';
            
                innerHtml += '<button class="item" data-toggle="tooltip" data-placement="top" title="Transfer Art Work Owner">';
                innerHtml += '<a href="#" onClick="NftArtWork_Transfer('+j+')";><i class="zmdi zmdi-mail-send"></i></a>';
                innerHtml += '</button>';

                innerHtml += '<button class="item" data-toggle="tooltip" data-placement="top" title="Move to Another Wallet">';
                innerHtml += '<a href="#" onClick="MoveTokenToAnotherWallet('+j+')";><i class="zmdi zmdi-mail-reply-all"></i></a>';
                innerHtml += '</button>';

                innerHtml += '<button class="item" data-toggle="tooltip" data-placement="top" title="Change Price">';
                innerHtml += '<a href="#" onClick="NftArtWork_ChangePrice('+j+')";><i class="zmdi zmdi-money"></i></a>';
                innerHtml += '</button>';
            }

            innerHtml += '<button class="item" data-toggle="tooltip" data-placement="top" title="Edit Additional Info">';
            innerHtml += '<a href="#" onClick="NftArtWork_EditMiniSite('+j+')";><i class="zmdi zmdi-view-web"></i></a>';
            innerHtml += '</button>';

            innerHtml += '</div></td>';

            innerHtml += '</tr>';
            innerHtml += '<tr class="spacer"></tr>';
        }
        
        innerHtml2 += '<table class="table table-data2">';
        innerHtml2 += '<thead>';
        innerHtml2 += '<tr>';
        innerHtml2 += '<th>NFT Id</th>';
        innerHtml2 += '<th>Name</th>';
        innerHtml2 += '<th>Owner Name</th>';
        innerHtml2 += '<th>Creation Date</th>';
        innerHtml2 += '<th>Est. Price (USD)</th>';
        innerHtml2 += '<th>Gold (USD)</th>';
        innerHtml2 += '<th>Gallery Token Control</th>';
        innerHtml2 += '<th></th>';
        innerHtml2 += '</tr>';
        innerHtml2 += '</thead>';
        innerHtml2 += '<tbody>';
        innerHtml2 += innerHtml;
        innerHtml2 += '</tbody>';
        innerHtml2 += '</table>';
    }
    $('#nftArtWorkDataTable').html(innerHtml2);
}


async function goldTokenInArtWork(artWorkId) {
    let j=0;
    let callContract = '';
    artWorkContractABI = artWorkABI();
    goldContractABI = goldABI();
    if (window.ethereum) {
        window.web3 = new Web3(window.ethereum);
        accounts = await getAccounts();
        Mycontract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
        MyContract2 = new web3.eth.Contract(goldContractABI,goldContract);
        callContract = await Mycontract.methods.goldTokenDeposited(artWorkId).call();
        console.log(callContract);
        console.log(callContract.length);
        let innerHtml = '';
        
        for (j=0; j<callContract.length; j++) {
            _tokenId = callContract[j];
            console.log(_tokenId);
            tokenURI = await MyContract2.methods.tokenURI(_tokenId).call();
            tokenURI = tokenURI.replace('data:application/json;base64,','');
            tokenURI = atob(tokenURI);
            tokenURI = tokenURI;
            tokenURI=JSON.parse(tokenURI);
            console.log(tokenURI)
            
            
            innerHtml += '<tr class="tr-shadow">';
            innerHtml += '<td>'+_tokenId+'</td>';
            innerHtml += '<td>$'+parseFloat(tokenURI.attributes[2].value/1e18).toFixed(2)+'</td>';
            innerHtml += '<td>'+tokenURI.attributes[1].value+' grs</td>';
            innerHtml += '<td>'+tokenURI.attributes[4].value+' %</td>';
            innerHtml += '</tr>';
            innerHtml += '<tr class="spacer"></tr>';
            console.log('J VALUE:'+j);
            
        }
        let innerHtml2 = '';
        innerHtml2 += '<table class="table table-data2">';
        innerHtml2 += '<thead>';
        innerHtml2 += '<tr>';
        innerHtml2 += '<th>gold token Id</th>';
        innerHtml2 += '<th>Price</th>';
        innerHtml2 += '<th>Weight</th>';
        innerHtml2 += '<th>Purity</th>';
        innerHtml2 += '</tr>';
        innerHtml2 += '</thead>';
        innerHtml2 += '<tbody>';
        innerHtml2 += innerHtml;
        innerHtml2 += '</tbody>';
        innerHtml2 += '</table>';
        
        $('#goldTokenInArtWorkTable').html(innerHtml2);
    }
}

async function _isApproveForAll(type) {
    if (type=="artWork") {
        ABI = artWorkABI();
        contract = artWorkContract;
        contractToCheck = goldContract;
    }else if (type=="gold") {
        ABI = goldABI();
        contract = goldContract;
        contractToCheck = artWorkContract;
    }
    if (window.ethereum) {
        
        window.web3 = new Web3(window.ethereum);
        accounts = await getAccounts();
        MyContract = new web3.eth.Contract(ABI,contract);
        callContract = await MyContract.methods.isApprovedForAll(accounts[0],contractToCheck).call();
        return callContract;
    }
}

async function NftArtWork_RemoveGold(artWorkId) {
    let j=0;
    let callContract = '';
    
    if (window.ethereum) {
        
        window.web3 = new Web3(window.ethereum);
        accounts =  await getAccounts();
        artWorkContractABI = artWorkABI();
        MyContract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
        
        const txHash = await MyContract.methods.removeGold(artWorkId).send({from: accounts[0]})
        .on('transactionHash', (hash) => {
            console.log('Processing...');
            $('#errorResponse').html('<center>Removing Gold NFT From Art Work... please wait</center>');
        })
        .then((receipt) => {
            console.log(receipt);
            window.location.href='listNFT.php?msgErr=The%20Gold%20NFT%20has%20been%20removed';
        })
        .catch((error) => {
            console.log(error);
            $('#errorResponse').html('<font color=red>'+error.message+'</font>');
        })
        
    }
} 

//aca sigo
async function sendTX_addGoldNFT() {
    var goldTokens = [];
    $("input:checkbox[name=selectedGoldToken]:checked").each(function() {
        goldTokens.push($(this).val());
    });
    if (goldTokens.length>0) {
        let nftId = $('#nftId').val();
        let callContract = '';
        
        if (window.ethereum) {
            window.web3 = new Web3(window.ethereum);
            accounts =  await getAccounts();
            artWorkContractABI = artWorkABI();
            MyContract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
            
            const txHash = await MyContract.methods.addGold(goldTokens,nftId).send({from: accounts[0]})
            .on('transactionHash', (hash) => {
                console.log('Processing...');
                $('#addGoldToArtWorkNFT').modal('hide');
                $('#errorResponse').html('<center>Adding NFT Gold to Art Work... please wait</center>');
            })
            .then((receipt) => {
                console.log(receipt);
                window.location.href='listNFT.php?msgErr=The%20Gold%20NFT%20has%20been%20included%20in%20your%20Art%20Work';
            })
            .catch((error) => {
                console.log(error);
                $('#errorResponse').html('<font color=red>'+error.message+'</font>');
            })
            
        }
    }else{
        //Error mandar mensaje, debe seleccionar algo!
        $('#errorFormAddGoldInArtWork').html('<font color="red">Select at least 1 gold Item!</font>');
    }
    
    
}

async function createArtWork() {
    if (window.ethereum) {
        artWorkContractABI = artWorkABI();
        Mycontract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
        accounts = await getAccounts();
        isAdmin = await Mycontract.methods.admin(accounts[0]).call();
        console.log(isAdmin);
        if (!isAdmin) {
            alert('Only Admin Contracts can Mint NFT');
        }else{
            $('#artWorkName').val();
            $('#artWorkPrice').val();
            $('#artWorkOwnerName').val();
            $('#artWorkImage').val();
            $('#artWorkRoyaltiesAmount').val();
            $('#artWorkRoyaltiesAddress').val();
            $('#mintArtWork').modal('show');
        }
    }
}

async function sendTX_mintArtWorkNFT() {
        let artWorkName = $('#artWorkName').val();
        let artWorkPrice = $('#artWorkPrice').val();
        let artWorkOwnerName = $('#artWorkOwnerName').val();
        let artWorkImage = $('#artWorkImage').val();
        let artWorkRoyaltiesAmount = $('#artWorkRoyaltiesAmount').val();
        let artWorkRoyaltiesAddress = $('#artWorkRoyaltiesAddress').val();
        
        artWorkRoyaltiesAmount = parseFloat(artWorkRoyaltiesAmount).toFixed(0);
        
        let error = 0;
        

        if (artWorkName=="") {
            $('#artWorkName').addClass("is-invalid form-control");
            error = 1;
        }else{
            $('#artWorkName').removeClass("is-invalid form-control")
            $('#artWorkName').addClass("form-control")
        }

        let cPrice = parseFloat(artWorkPrice).toFixed(0);  
        if (cPrice=="NaN") {
            $('#artWorkPrice').addClass("is-invalid form-control");
            error = 1;
            
        }else{
            $('#artWorkPrice').removeClass("is-invalid form-control")
            $('#artWorkPrice').addClass("form-control")
        }
        
        if (artWorkOwnerName=="") {
            $('#artWorkOwnerName').addClass("is-invalid form-control");
            error = 1;
        }else{
            $('#artWorkOwnerName').removeClass("is-invalid form-control")
            $('#artWorkOwnerName').addClass("form-control")
        }


        if (artWorkRoyaltiesAmount=="NaN") {
            $('#artWorkRoyaltiesAmount').addClass("is-invalid form-control");
            error = 1;
        }else{
            $('#artWorkRoyaltiesAmount').removeClass("is-invalid form-control")
            $('#artWorkRoyaltiesAmount').addClass("form-control")
        }

        if (artWorkRoyaltiesAddress=="") {
            $('#artWorkRoyaltiesAddress').addClass("is-invalid form-control");
            error = 1;
        }else{
            $('#artWorkRoyaltiesAddress').removeClass("is-invalid form-control")
            $('#artWorkRoyaltiesAddress').addClass("form-control")
        }

        if (web3.utils.isAddress(artWorkRoyaltiesAddress)===false) {
            $('#artWorkRoyaltiesAddress').addClass("is-invalid form-control");
            error = 1;
        }else{
            $('#artWorkRoyaltiesAddress').removeClass("is-invalid form-control")
            $('#artWorkRoyaltiesAddress').addClass("form-control")
        }

        if (artWorkImage=="") {
            $('#artWorkImage').addClass("is-invalid form-control");
            error = 1;
        }else{
            $('#artWorkImage').removeClass("is-invalid form-control")
            $('#artWorkImage').addClass("form-control")
        }

        //nextNftId

        if (window.ethereum && error == 0) {
            window.web3 = new Web3(window.ethereum);
            accounts = await getAccounts();
            artWorkContractABI = artWorkABI();
            
            artWorkPrice = Web3.utils.toWei(cPrice,'ether');
            MyContract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
            
            const txHash = await MyContract.methods.createArtWork(artWorkOwnerName,artWorkPrice,artWorkRoyaltiesAmount,artWorkRoyaltiesAddress,artWorkName).send({from: accounts[0]})
            .on('transactionHash', (hash) => {
                console.log('Processing...');
                $('#mintArtWork').modal('hide');
                $('#errorResponse').html('<center><font color="red">Minting Art Work NFT... please wait</font></center>');
            })
            .then((receipt) => {
                console.log(receipt);
                $('#errorResponse').html('<center>Almost done... do not close your browser</center>');
                let nextNftId = receipt.events.Transfer.returnValues[2];
                $('#nextNftId').val(nextNftId);
                document.getElementById("createNFTFormWithPic").submit();
            })
            .catch((error) => {
                console.log(error);
                $('#errorResponse').html('<font color=red>'+error.message+'</font>');
            })
            
        }
}

async function _calculateTransferCost(_tokenId) {
    if (window.ethereum) {
        artWorkContractABI = artWorkABI();
        window.web3 = new Web3(window.ethereum);
        Mycontract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
        transferCostValue = await Mycontract.methods.changeOwnerCosts(_tokenId).call();
        transferCostValueToShow = transferCostValue[0]/(1e18);
        transferCostValueToShow = transferCostValueToShow.toFixed(0);
        return transferCostValueToShow;
    }
}

async function _calculateRoyaltiesToChangePrice(_tokenId,_newAmount) {
    // La nueva funcion calcula el diff en el contrato
    if (window.ethereum) {
        artWorkContractABI = artWorkABI();
        window.web3 = new Web3(window.ethereum);
        Mycontract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
        _newAmount = Web3.utils.toWei(_newAmount,'ether');
        transferCostValue = await Mycontract.methods.changePriceCost(_tokenId,_newAmount).call();
        transferCostValueToShow = transferCostValue[3]/(1e18);
        transferCostValueToShow = transferCostValueToShow.toFixed(0);
        return transferCostValueToShow;
    }
}
async function checkAnAddress(address) {
    if (window.ethereum) {
        window.web3 = new Web3(window.ethereum);
        isAddress = web3.utils.isAddress(address);
        return isAddress;
    }
}

async function sendTX_changeOwnerWorkNFT() {
    let _nftId = $('#_nftId').val();
    let getNewName = $('#artWorkNewName').val();
    let _artWorkAddress = $('#artWorkAddress').val();
    let checkTheAddress = await checkAnAddress(_artWorkAddress);
    let confirmTransferToken = $('#confirmTransferToken').val();
    if (confirmTransferToken=="YES") confirmTransferToken='true';
    if (confirmTransferToken=="NO") confirmTransferToken='false';
    error = 0;
    if (getNewName=="") {
        $('#artWorkNewName').addClass("is-invalid form-control");
        error = 1;
    }else{
        $('#artWorkAddress').removeClass("is-invalid form-control")
        $('#artWorkAddress').addClass("form-control")
    }

    if (checkTheAddress===true) {
        $('#artWorkAddress').removeClass("is-invalid form-control")
        $('#artWorkAddress').addClass("form-control")
    }else{
        $('#artWorkAddress').addClass("is-invalid form-control");
        error = 1;
    }
    
    if (window.ethereum && error == 0) {
        window.web3 = new Web3(window.ethereum);
        accounts = await getAccounts();
        artWorkContractABI = artWorkABI();
        MyContract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
        
        const txHash = await MyContract.methods.changeOwnerAndTransfer(_nftId,getNewName,confirmTransferToken,_artWorkAddress).send({from: accounts[0]})
        .on('transactionHash', (hash) => {
            console.log('Processing...');
            $('#transferArtWorkOwner').modal('hide');
            $('#errorResponse').html('<center><font color="red">Changing Art Work NFT name... please wait</font></center>');
        })
        .then((receipt) => {
            console.log(receipt);
            window.location.href='listNFT.php?msgErr=The%20Name%20has%20been%20changed';
        })
        .catch((error) => {
            console.log(error);
            $('#errorResponse').html('<font color=red>'+error.message+'</font>');
        })
        
    }
    
}

async function _detailGoldSupport(_tokenId) {
    if (window.ethereum) {
        let goldValueinArtWork = 0;
        artWorkContractABI = artWorkABI();
        window.web3 = new Web3(window.ethereum);
        Mycontract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
        gTDepo = await Mycontract.methods.goldTokenDeposited(_tokenId).call();
        if (gTDepo.length > 0) {
            transferCostValue = await Mycontract.methods.detailGoldSupport(_tokenId).call();
            goldValueinArtWork = transferCostValue[0]/(1e18);
            goldValueinArtWork = parseFloat(goldValueinArtWork).toFixed(2);
        }
        return goldValueinArtWork;
    }
}

async function _ownerOf(_tokenId) {
    if (window.ethereum) {
        accounts = await getAccounts();
        artWorkContractABI = artWorkABI();
        window.web3 = new Web3(window.ethereum);
        Mycontract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
        gTDepo = await Mycontract.methods.ownerOf(_tokenId).call();
        
        if (gTDepo.toLowerCase()==accounts[0].toLowerCase()) {
            console.log(_tokenId+":TRUE");
            return "1";
        }else{
            console.log(_tokenId+":FALSE");
            return "0";
        }
    }
}
async function sendTX_changePriceArtWorkNFT() {
    artWorkActualPrice = $('#artWorkActualPrice').val();
    artWorkActualPriceGwei = $('#artWorkActualPriceGwei').val();
    usdcBalanceAddressinChange = $('#usdcBalanceAddressinChange').val();
    artWorkMinPriceToChange = $('#artWorkMinPriceToChange').val();
    artWorkChangePriceCost = $('#artWorkChangePriceCost').val();
    _nftIdChangePrice = $('#_nftIdChangePrice').val();
    artWorkNewPrice = $('#artWorkNewPrice').val();
    _artWorkNewPrice = parseFloat(artWorkNewPrice).toFixed(0);
    _artWorkNewPrice = Web3.utils.toWei(_artWorkNewPrice,'ether');
    console.log(_artWorkNewPrice)
    if (window.ethereum) {
        $('#changeArtWorkNftPrice').modal('hide');
        window.web3 = new Web3(window.ethereum);
        accounts = await getAccounts();
        artWorkContractABI = artWorkABI();
        MyContract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
        
        const txHash = await MyContract.methods.changePrice(_nftIdChangePrice,_artWorkNewPrice).send({from: accounts[0]})
        .on('transactionHash', (hash) => {
            console.log('Processing...');
            
            $('#errorResponse').html('<center><font color="red">Changing Art Work NFT price... please wait</font></center>');
        })
        .then((receipt) => {
            console.log(receipt);
            window.location.href='listNFT.php?msgErr=The%20Price%20has%20been%20changed';
        })
        .catch((error) => {
            console.log(error);
            $('#errorResponse').html('<font color=red>'+error.message+'</font>');
        })
    }
}

async function checkAllAllowance() {
    if (window.ethereum) {
        goldUsdcAllowance = await isAllowanceOnGold();
        artWorkUsdcAllowance = await isAllowanceOnArtWork();
        NftGoldOnArtWork = await _isApproveForAll('gold');
        
        let counter=0;
        innerHtml = '';
        
        
            innerHtml += '<div class="row">';

            innerHtml += '<div class="col-md-4">';
                innerHtml +='<div class="card">';
                innerHtml +='<div class="card-header">';
                innerHtml +='<strong class="card-title mb-3">USDC On Gold Contract</strong>';
                    innerHtml +='</div>';
                    innerHtml +='<div class="card-body">';
                        innerHtml +='<div class="mx-auto d-block">';
                            innerHtml +='<img class="rounded-circle mx-auto d-block" src="images/smartContract.png" alt="SmartContract">';
                            innerHtml +='<h5 class="text-sm-center mt-2 mb-1">Allowance: $'+goldUsdcAllowance/(1e18)+'</h5>';
                            
                        innerHtml +='</div>';
                        innerHtml +='<hr>';
                        innerHtml +='<div class="card-text text-sm-center">';

                            if (goldUsdcAllowance < 50*(1e18)) { //allowance > $50
                                innerHtml +='<button type="button" class="btn btn-primary btn-sm" onClick="setNewAllowance(1);">';
                                innerHtml += '<i class="fa fa-dot-circle-o"></i> Increase Allowance';
                                innerHtml +='</button>';
                            }
                        
                        innerHtml +='</div>';
                    innerHtml +='</div>';
                innerHtml +='</div>';



                

            innerHtml += '</div>';

           


            innerHtml += '<div class="col-md-4">';
                innerHtml +='<div class="card">';
                innerHtml +='<div class="card-header">';
                innerHtml +='<strong class="card-title mb-3">USDC On Art Work Contract</strong>';
                    innerHtml +='</div>';
                    innerHtml +='<div class="card-body">';
                        innerHtml +='<div class="mx-auto d-block">';
                            innerHtml +='<img class="rounded-circle mx-auto d-block" src="images/smartContract.png" alt="SmartContract">';
                            innerHtml +='<h5 class="text-sm-center mt-2 mb-1">Allowance: $'+artWorkUsdcAllowance/(1e18)+'</h5>';
                            
                        innerHtml +='</div>';
                        innerHtml +='<hr>';
                        innerHtml +='<div class="card-text text-sm-center">';

                            if (artWorkUsdcAllowance < 50*(1e18)) { //allowance > $50
                                innerHtml +='<button type="button" class="btn btn-primary btn-sm" onClick="setNewAllowance(2);">';
                                innerHtml += '<i class="fa fa-dot-circle-o"></i> Increase Allowance';
                                innerHtml +='</button>';
                            }
                        
                        innerHtml +='</div>';
                    innerHtml +='</div>';
                innerHtml +='</div>';



                

            innerHtml += '</div>';




            innerHtml += '<div class="col-md-4">';
                innerHtml +='<div class="card">';
                innerHtml +='<div class="card-header">';
                innerHtml +='<strong class="card-title mb-3">NFT Gold On Art Work</strong>';
                    innerHtml +='</div>';
                    innerHtml +='<div class="card-body">';
                        innerHtml +='<div class="mx-auto d-block">';
                            innerHtml +='<img class="rounded-circle mx-auto d-block" src="images/smartContract.png" alt="SmartContract">';
                            innerHtml +='<h5 class="text-sm-center mt-2 mb-1">Allowance: '+NftGoldOnArtWork+'</h5>';
                            
                        innerHtml +='</div>';
                        innerHtml +='<hr>';
                        innerHtml +='<div class="card-text text-sm-center">';

                            if (NftGoldOnArtWork===false) { //allowance false
                                innerHtml +='<button type="button" class="btn btn-primary btn-sm" onClick="setNewAllowance(3);">';
                                innerHtml += '<i class="fa fa-dot-circle-o"></i> Permit Allowance on ALL NFT';
                                innerHtml +='</button>';
                            }
                        
                        innerHtml +='</div>';
                    innerHtml +='</div>';
                innerHtml +='</div>';



                

            innerHtml += '</div>';
            
        
        $('#contentInnerHtml').html(innerHtml);
    }
}
async function setNewAllowance(type) {
    $('#newAllowanceError').html('');
    if (window.ethereum) {
        window.web3 = new Web3(window.ethereum);
        accounts =  await getAccounts();
        if (type==1) {
            ABI = usdcABI();
            contractDestination = usdcContract;
            contract = goldContract;
            useType=1;
        }else if (type==2) {
            ABI = usdcABI();
            contractDestination = usdcContract;
            contract = artWorkContract;
            useType=1;
        }else{
            ABI = goldABI();
            contractDestination = goldContract;
            contractToCheck = artWorkContract;
            useType=2;
        }
        const amountToSpend = Web3.utils.toWei('10000000000000000','ether');
        MyContract = new web3.eth.Contract(ABI,contractDestination);
        
        if (useType==1) {
            const txHash = await MyContract.methods.approve(contract,amountToSpend).send({from: accounts[0]})
            .on('transactionHash', (hash) => {
                console.log('Processing...');
                
                $('#newAllowanceError').html('<center><font color="red">Please Wait While the transaction is beign processed...</font></center>');
            })
            .then((receipt) => {
                console.log(receipt);
                checkAllAllowance();
            })
            .catch((error) => {
                console.log(error);
                $('#newAllowanceError').html('<font color=red>'+error.message+'</font>');
            })
        }else if (useType==2) {
            const txHash = await MyContract.methods.setApprovalForAll(contractToCheck,"true").send({from: accounts[0]})
            .on('transactionHash', (hash) => {
                console.log('Processing...');
                
                $('#newAllowanceError').html('<center><font color="red">Please Wait While the transaction is beign processed...</font></center>');
            })
            .then((receipt) => {
                console.log(receipt);
                checkAllAllowance();
            })
            .catch((error) => {
                console.log(error);
                $('#newAllowanceError').html('<font color=red>'+error.message+'</font>');
            })
        }
    }
}

async function moveToken() {
    var to = $('#destinationTransfer').val();
    
    var _tokenId = $('#_tokenId').val();
    $('#destinationTransfer').removeClass("is-invalid form-control")
    $('#destinationTransfer').addClass("form-control")
    
        if (window.ethereum) {
            window.web3 = new Web3(window.ethereum);
            accounts = await getAccounts();
            
            if (web3.utils.isAddress(to)===true) {
                $('#moveTokenModal').modal('hide');
                
                artWorkContractABI = artWorkABI();
                MyContract = new web3.eth.Contract(artWorkContractABI,artWorkContract);
                
                const txHash = await MyContract.methods.transferFrom(accounts[0],to,_tokenId).send({from: accounts[0]})
                .on('transactionHash', (hash) => {
                    console.log('Processing...');
                    $('#errorResponse').html('<center><font color="red">Moving Token to Wallet: '+to+'</font></center>');
                })
                .then((receipt) => {
                    console.log(receipt);
                    window.location.href='listNFT.php?msgErr=Ready!';
                })
                .catch((error) => {
                    console.log(error);
                    $('#errorResponse').html('<font color=red>'+error.message+'</font>');
                })
            }else{
                $('#destinationTransfer').addClass("is-invalid form-control");
            }
        }
   
}
