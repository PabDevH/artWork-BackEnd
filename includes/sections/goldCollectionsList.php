<section class="statistic statistic2">
    <div class="container">
        <div id="contentInnerHtml"><p align="center"><img src="images/loading-42.webp"></p></div>
    </div>
</section>



<!-- INCREASE ALLOWANCE -->
<div class="modal fade" id="increaseUSDC_GoldAllowance" tabindex="-1" role="dialog" aria-labelledby="increaseUSDC_GoldAllowancedLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="increaseUSDC_GoldAllowanceLabel">Increase Allowance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <div id="allowanceUSDCGOLD_Text">Allow NFT Gold Contract to use your USDC</div>
                </p>
            </div>
            <div class="modal-footer" id="allowanceUSDCGOLD_Button">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onClick="sendTX_allowanceUSDGOLD();">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- END INCREASE ALLOWANCE -->

<!-- MINT (BUY) GOLD -->
<div class="modal fade" id="mintGoldNFT" tabindex="-1" role="dialog" aria-labelledby="mintGoldNFTLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mintGoldNFTLabel">Mint Gold NFT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    

                    <div class="card">
                        <div class="card-header">
                            <strong>Complete the Form</strong>
                        </div>
                        <div id="errorForm"></div>
                        <div class="card-body card-block" id="MintGOLD_Text">
                        
                            <div class="row form-group">
                                    
                                    <div class="col col-md-4">
                                        <label for="goldTokenQty" class=" form-control-label">Quantity</label>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <input type="text" id="goldTokenQty" name="goldTokenQty" placeholder="grs"  class="form-control">
                                        
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="goldMintTokenId" class=" form-control-label">Token ID</label>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <input type="text" id="goldMintTokenId" name="goldMintTokenId" readonly class="form-control">
                                        
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-4">
                                        <label for="goldMintPrice" class=" form-control-label">Price</label>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <input type="text" id="goldMintPrice" name="goldMintPrice" readonly class="form-control">
                                        
                                    </div>
                                </div>
                                
                            
                        </div>
                        <div class="card-footer" id="MintGOLD_Button">
                            <button type="button" class="btn btn-primary btn-sm" onClick="sendTX_MintGOLD();"> 
                                <i class="fa fa-dot-circle-o"></i> Mint
                            </button>
                            
                        </div>
                    </div>

                </p>
            </div>
            <div class="modal-footer" div id="MintGOLD_CancelButton">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                
            </div>
        </div>
    </div>
</div>
<!-- END MINT (BUY) GOLD -->