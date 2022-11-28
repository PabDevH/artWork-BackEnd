<!-- DATA TABLE-->
<div align="center" id="errorResponse"><?php if ($_GET['msgErr']) echo $_GET['msgErr']; ?></div>
<section class="p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">NFT Art Work</h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-right">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small" type="button" onClick="createArtWork();">
                            <i class="zmdi zmdi-plus"></i>mint art Work NFT</button>
                        
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2" id="nftArtWorkDataTable">
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END DATA TABLE-->

<!-- VIEW NFT IMAGE -->
<div class="modal fade" id="viewArtWorkImage" tabindex="-1" role="dialog" aria-labelledby="viewArtWorkImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewArtWorkImageLabel">View Art Work Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <div id="artWorkImageDiv"></div>
                </p>
            </div>
            
        </div>
    </div>
</div>
<!-- END VIEW NFT IMAGE -->

<!-- VIEW GOLD IN ART WORK -->
<div class="modal fade" id="viewGoldinArtWork" tabindex="-1" role="dialog" aria-labelledby="viewGoldinArtWorkLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewGoldinArtWorkLabel">View Gold In Art Work</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                <p>
                    <div id="goldTokenInArtWorkTable"></div>
                </p>
            </div>
            
        </div>
    </div>
</div>
<!-- END VIEW GOLD IN ART WORK -->

<!-- ADD GOLD TO ART WORK -->
<div class="modal fade" id="addGoldToArtWorkNFT" tabindex="-1" role="dialog" aria-labelledby="addGoldToArtWorkNFTLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGoldToArtWorkNFTLabel">Add Gold to NFT Art Work</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <div id="errorFormAddGoldInArtWork"></div>
                </p>
                <p>
                    <div id="addGoldToArtWorkNFTTable"></div>
                </p>
            </div>
            <div class="modal-footer" id="allowanceUSDCGOLD_Button">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onClick="sendTX_addGoldNFT();">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- END ADD GOLD TO ART WORK -->

<!-- MINT ART WORK NFT -->
<div class="modal fade" id="mintArtWork" tabindex="-1" role="dialog" aria-labelledby="mintArtWorkLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mintArtWork">Mint Art Work NFT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <div id="errorForm"></div>
                </p>

                <form name="createNFTFormWithPic" enctype="multipart/form-data" id="createNFTFormWithPic" method="POST" action="listNFT.php">
                <div class="card">
                        <div class="card-header">
                            <strong>Complete the Form</strong>
                        </div>

                        <div class="card-body card-block">
                            <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="artWorkName" class=" form-control-label">Name</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="artWorkName" name="artWorkName" placeholder="Enter Art Work Name..." class="form-control">
                                
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="artWorkPrice" class=" form-control-label">Price</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="artWorkPrice" name="artWorkPrice" placeholder="Enter Art Work Price (WITHOUT DECIMALS)..." class="form-control">
                                
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="artWorkOwnerName" class=" form-control-label">Owner Name</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="artWorkOwnerName" name="artWorkOwnerName" placeholder="Enter Owner Name..." class="form-control">
                                
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="artWorkRoyaltiesAmount" class=" form-control-label">Royalties Amount Percent</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="artWorkRoyaltiesAmount" name="artWorkRoyaltiesAmount" placeholder="Enter only numbers from 1 to 5..." class="form-control">
                                
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="artWorkRoyaltiesAddress" class=" form-control-label">Royalties Address</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="artWorkRoyaltiesAddress" name="artWorkRoyaltiesAddress" placeholder="Enter Artist Address" class="form-control">
                                
                            </div>
                        </div>


                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="artWorkImage" class=" form-control-label">Select Art Work Image</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="artWorkImage" name="artWorkImage" placeholder="Select image.." class="form-control">
                                <span class="help-block">Please use jpg with good definition.</span>
                            </div>
                        </div>
                                                          
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary btn-sm" onClick="sendTX_mintArtWorkNFT();"> 
                            <i class="fa fa-dot-circle-o"></i> Mint NFT
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </div>


            </div>
            <input type="hidden" id="action" name="action" value="createNFTArtWork">
            <input type="hidden" id="nextNftId" name="nextNftId" value="">
            </form> 
            <div class="modal-footer" id="mintSectionButtonClose">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <!--<button type="button" class="btn btn-primary" onClick="sendTX_mintArtWorkNFT();">Confirm</button>-->
            </div>
        </div>
    </div>
</div>
<!-- END MINT ART WORK NFT -->

<!-- TRANSFER OWNER ART WORK NFT -->
<div class="modal fade" id="transferArtWorkOwner" tabindex="-1" role="dialog" aria-labelledby="transferArtWorkOwnerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transferArtWorkOwner">Transfer Art Work Owner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <div id="errorForm"></div>
                </p>

                <div class="card">
                        <div class="card-header">
                            <strong>Complete the Form</strong>
                        </div>

                        <div class="card-body card-block">

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="artWorkTransferCost" class=" form-control-label">Transaction Value</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="artWorkTransferCost" name="artWorkTransferCost" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="usdcBalanceAddress" class=" form-control-label">Your Balance</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="usdcBalanceAddress" name="usdcBalanceAddress" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="artWorkNewName" class=" form-control-label">New Name</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="artWorkNewName" name="artWorkNewName" placeholder="Enter New Owner Name..." class="form-control" maxlength="40">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="artWorkAddress" class=" form-control-label">Owner Address</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="artWorkAddress" name="artWorkAddress" placeholder="Enter Owner Address" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="confirmTransferToken" class=" form-control-label">Transfer Token?</label>
                                </div>
                                <div class="col-12 col-md-9"> 
                                    <select name="confirmTransferToken" id="confirmTransferToken" class="form-control">
                                        <option value="NO">NO, Keep it under my custodial</option>
                                        <option value="YES">YES, Send the Token</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                    <div class="card-footer" id="showFooter">
                        <input type="hidden" id="_nftId" name="_nftId" value="">
                        <button type="button" class="btn btn-primary btn-sm" onClick="sendTX_changeOwnerWorkNFT();"> 
                            <i class="fa fa-dot-circle-o"></i> Send TX
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </div>


            </div>
            <div class="modal-footer" id="mintSectionButtonClose">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- END TRANSFER OWNER ART WORK NFT -->


<!-- CHANGE PRICE ART WORK NFT -->
<div class="modal fade" id="changeArtWorkNftPrice" tabindex="-1" role="dialog" aria-labelledby="changeArtWorkNftPriceLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeArtWorkNftPrice">Change Art Work Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <div id="errorForm"></div>
                </p>

                <div class="card">
                        <div class="card-header">
                            <strong>Complete the Form</strong>
                        </div>

                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="artWorkActualPrice" class=" form-control-label">Actual Price</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="hidden" id="artWorkActualPriceGwei" name="artWorkActualPriceGwei" value="">
                                    <input type="text" id="artWorkActualPrice" name="artWorkActualPrice" readonly class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="artWorkMinPriceToChange" class=" form-control-label">Min. Price</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="artWorkMinPriceToChange" name="artWorkMinPriceToChange" readonly class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="artWorkNewPrice" class=" form-control-label">New Price</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="artWorkNewPrice" name="artWorkNewPrice"  class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="artWorkChangePriceCost" class=" form-control-label">Total Cost</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="artWorkChangePriceCost" name="artWorkChangePriceCost" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="usdcBalanceAddressinChange" class=" form-control-label">Your Balance</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="usdcBalanceAddressinChange" name="usdcBalanceAddressinChange" class="form-control" readonly>
                                </div>
                            </div>

                            
                            
                        </div>
                    <div class="card-footer" id="showFooter">
                        <input type="hidden" id="_nftIdChangePrice" name="_nftIdChangePrice" value="">
                        <button type="button" class="btn btn-primary btn-sm" onClick="sendTX_changePriceArtWorkNFT();"> 
                            <i class="fa fa-dot-circle-o"></i> Send TX
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </div>


            </div>
            <div class="modal-footer" id="mintSectionButtonClose">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- END CHANGE PRICE ART WORK NFT -->



<!--EDIT ADDITIONAL INFORMATION -->

<div class="modal fade" id="tokenAdditionalInformation" tabindex="-1" role="dialog" aria-labelledby="tokenAdditionalInformationLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form method="POST" action="listNFT.php" enctype="multipart/form-data" id="tokenAdditionalInformationForm" name="tokenAdditionalInformationForm" class="form-horinzotal">
                <input type="hidden" name="action" value="editMiniWebsiteInfo">
                <input type="hidden" name="tokenIdEditWebsite" id="tokenIdEditWebsite" value=''>
                <div class="modal-header">
                    <h5 class="modal-title" id="tokenAdditionalInformationLabel">Art Work Additional Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        
                            <div id="errorForm"></div>

                            <div class="card">
                                <div class="card-header">
                                    <strong>Complete the Form</strong>
                                </div>
                                <div class="card-body card-block">
                                
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="authorId" class=" form-control-label">Author</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                            <input type="text" id="authorName" name="authorName" placeholder="Enter Author..." class="form-control">
                                                <span class="help-block">Please select the Artist / Author</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="title" class=" form-control-label">Title</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="title" name="title" placeholder="Enter Title..." class="form-control">
                                                <span class="help-block">Please enter Title</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="place" class=" form-control-label">Place</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="place" name="place" placeholder="Enter Place..." class="form-control">
                                                <span class="help-block">Please enter Place</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="year" class=" form-control-label">Year</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input maxlength="4" type="text" id="year" name="year" placeholder="Enter Year..." class="form-control">
                                                <span class="help-block">YYYY</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="collection" class=" form-control-label">Collection & Category</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="text" id="collection" name="collection" placeholder="Enter Collection..." class="form-control">
                                                <span class="help-block">Please enter Collection</span>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="text" id="category" name="category" placeholder="Enter category..." class="form-control">
                                                <span class="help-block">Please enter Category</span>
                                            </div>
                                        </div>
                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="width" class=" form-control-label">Width & Heigth</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="text" id="width" name="width" placeholder="Enter width..." class="form-control">
                                                <span class="help-block">Please enter the width</span>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="text" id="heigth" name="heigth" placeholder="Enter heigth..." class="form-control">
                                                <span class="help-block">Please enter the heigth</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="unit" class=" form-control-label">Unit</label>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <input type="text" id="units" name="units" placeholder="Enter Unit name (inch, cm...)" class="form-control">
                                                <span class="help-block">Please enter unit for width / heigth</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="inscription" class=" form-control-label">Inscription</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="inscription" name="inscription" placeholder="Enter Inscription" class="form-control">
                                                <span class="help-block">Please enter Inscription</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="technique" class=" form-control-label">Technique</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="technique" name="technique" placeholder="Enter Technique" class="form-control">
                                                <span class="help-block">Please enter technique</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="conservation" class=" form-control-label">Conservation</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="conservation" name="conservation" placeholder="Enter Conservation" class="form-control">
                                                <span class="help-block">Please enter Conservation</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="additionalNotes" class=" form-control-label">Additional Notes</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="additionalNotes" name="additionalNotes" placeholder="Enter Additional Notes" class="form-control">
                                                <span class="help-block">Please enter Additional Notes</span>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="width" class=" form-control-label">Front</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="file" id="frontImage" name="frontImage" placeholder="Select a Front Image..." class="form-control">
                                                <span class="help-block">Please select a Front Image</span>
                                            </div>
                                            <div class="col-12 col-md-4" id="frontImageDiv">
                                                
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="width" class=" form-control-label">Reverse Image</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="file" id="reverseImage" name="reverseImage" placeholder="Select a Reverse Image..." class="form-control">
                                                <span class="help-block">Please select a Front Image</span>
                                            </div>
                                            <div class="col-12 col-md-4" id="reverseImageDiv">
                                                
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="width" class=" form-control-label">Inscription</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="file" id="inscriptionImage" name="inscriptionImage" placeholder="Select an Inscription Image..." class="form-control">
                                                <span class="help-block">Please select an Inscription Image</span>
                                            </div>
                                            <div class="col-12 col-md-4" id="inscriptionImageDiv">
                                                
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="width" class=" form-control-label">Sign Image</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="file" id="signImage" name="signImage" placeholder="Select a Sign Image..." class="form-control">
                                                <span class="help-block">Please select a Sign Image</span>
                                            </div>
                                            <div class="col-12 col-md-4" id="signImageDiv">
                                                
                                            </div>
                                            
                                        </div>

                                        
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="emissionDate" class=" form-control-label">Certificates URLs</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="text" id="certificate1" name="certificate1" placeholder="Enter Certificate URL..." class="form-control">
                                                <span class="help-block">Please enter the Url</span>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="text" id="certificate2" name="certificate2" placeholder="Enter Certificate URL..." class="form-control">
                                                <span class="help-block">Please enter the Url</span>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="emissionDate" class=" form-control-label">Certificates URLs</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="text" id="certificate3" name="certificate3" placeholder="Enter Certificate URL..." class="form-control">
                                                <span class="help-block">Please enter the Url</span>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="text" id="certificate4" name="certificate4" placeholder="Enter Certificate URL..." class="form-control">
                                                <span class="help-block">Please enter the Url</span>
                                            </div>
                                        </div>

                                        


                                    
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary btn-sm" id="SendNftArtWork_EditMiniSite"> 
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                </div>
                            </div>
                        
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel & Close</button>
                    
                </div>
            </form>                        
        </div>
    </div>
</div>

<!--END CREATE NEW CERTIFICATE -->



<!-- TRANSFERFROM -->
<div class="modal fade" id="moveTokenModal" tabindex="-1" role="dialog" aria-labelledby="moveTokenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="moveTokenModal">Move Token</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <div id="errorForm"></div>
                </p>

                <div class="card">
                        <div class="card-header">
                            <strong>Complete the Form</strong>
                        </div>

                        <div class="card-body card-block">
                            

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="destinationTransfer" class=" form-control-label">Address Destination</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="destinationTransfer" name="destinationTransfer" class="form-control">
                                </div>
                            </div>

                            
                            
                        </div>
                    <div class="card-footer" id="showFooter">
                        <input type="hidden" id="_tokenId" name="_tokenId" value="">
                        <button type="button" class="btn btn-primary btn-sm" onClick="moveToken();"> 
                            <i class="fa fa-dot-circle-o"></i> Send TX
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </div>


            </div>
            <div class="modal-footer" id="mintSectionButtonClose">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- END CHANGE PRICE ART WORK NFT -->