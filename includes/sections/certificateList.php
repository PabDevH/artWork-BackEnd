<!-- DATA TABLE-->
<section class="p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">Certificates List</h3>
                <?php if ($messageConfirmation) { ?><h6><font color='red'><center><?php echo $messageConfirmation ?></center></font></h6><?php } ?>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        
                        <form action="certificates.php" method="GET">
                        


                            <div class="row form-group">
                            <div class="col col-md-12">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                    <input type="text" id="searchCertificate" name="searchCertificate" placeholder="Certificate to search" value="<?php echo $_GET['searchCertificate'] ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        </form>
                    </div>
                    <div class="table-data__tool-right">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" type="button" data-toggle="modal" data-target="#createCertificate">
                            <i class="zmdi zmdi-plus"></i>create certificate</button>
                        
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>
                                    certId
                                </th>
                                <th>author</th>
                                <th>title</th>
                                <th>place</th>
                                <th>year</th>
                                <th>collection</th>
                                <th>category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                                if ($_GET['searchCertificate']) {
                                    $sqlExtraCertificate = " WHERE (certificates.hash='".$_REQUEST['searchCertificate']."' OR certificates.id='".$_REQUEST['searchCertificate']."' OR certificates.title like('%%".$_REQUEST['searchCertificate']."%%') ) ";
                                }

                                $sql = "SELECT 
                                certificates.certId,
                                certificates.title,
                                certificates.place,
                                certificates.year,
                                certificates.collection,
                                certificates.category,
                                certificates.hash,
                                certificates.tokenId,
                                authors.name,
                                authors.lastname,
                                authors.authorId
                                    FROM certificates 
                                    INNER JOIN authors
                                    ON certificates.authorId=authors.authorId
                                    ".$sqlExtraCertificate." ORDER by certId ASC";
                                
                                $res = mysqli_query($conn, $sql);
                                $rows = mysqli_num_rows($res);
                                
                                while($dat=mysqli_fetch_array($res)) {
                                    
                                    
                            ?>
                            <tr class="tr-shadow">
                                <td><?php echo $dat[0] ?></td>
                                <td><?php echo $dat[7] ?>&nbsp;<?php echo $dat[8] ?></td>
                                <td><span class="block-email"><?php echo $dat[1] ?></span></td>
                                <td class="desc"><?php echo $dat[2] ?></td>
                                <td><?php echo $dat[3] ?></td>
                                <td><span class="status--process"><?php echo $dat[4] ?></span></td>
                                <td><?php echo $dat[5] ?></td>
                                <td>
                                    <div class="table-data-feature">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="View PDF">
                                            <a href="/web3/vertical/certificates/?hash=<?php echo $dat[6] ?>" target="_BLANK"><i class="zmdi zmdi-collection-pdf"></i></a>
                                        </button>
                                        <?php
                                            if ($dat['tokenId']=="") {
                                        ?>
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Create Certificate / Art Work Token">
                                                    <a href="#" onClick="createCertificateToken(<?php echo $dat[6] ?>);"><i class="zmdi zmdi-device-hub"></i></a>
                                                </button>
                                        <?php
                                            }
                                        ?>
                                        <!--
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <a href="#" onClick="deleteCertificate(<?php echo $dat[0] ?>);"><i class="zmdi zmdi-delete"></i></a>
                                        </button>
                                        -->
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            
                            <?php
                                }
                                if ($rows==0) {
                                    ?>
                                        <tr class="tr-shadow">
                                            <td colspan=8 align="center">
                                                No certificates to show
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END DATA TABLE-->

<!--CREATE NEW CERTIFICATE -->

<div class="modal fade" id="createCertificate" tabindex="-1" role="dialog" aria-labelledby="createCertificateLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form method="POST" action="certificates.php" enctype="multipart/form-data" id="createCertificateForm" name="createCertificateForm" class="form-horinzotal">
                <input type="hidden" name="action" value="createCertificate">
            
                <div class="modal-header">
                    <h5 class="modal-title" id="createCertificateLabel">Create a new Certificate</h5>
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
                                                <select name="authorId" id = "authorId" class="form-control" size="1">
                                                    <?php
                                                        $sqlAuthor = "SELECT name,lastname,authorId FROM authors ORDER by lastname,name";
                                                        $resAuthor = mysqli_query($conn, $sqlAuthor);
                                                        while($datAuthor = mysqli_fetch_array($resAuthor)) {
                                                            ?>
                                                                <option value="<?php echo $datAuthor['authorId'] ?>"><?php echo $datAuthor['lastname']." ".$datAuthor['name']; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                                <span class="help-block">Please select the Artist / Author</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="title" class=" form-control-label">Title</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="title" name="title" placeholder="Enter Certificate Title..." class="form-control">
                                                <span class="help-block">Please enter Certificate Title</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="place" class=" form-control-label">Certificate Place</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="place" name="place" placeholder="Enter Certificate Place..." class="form-control">
                                                <span class="help-block">Please enter Certificate Place</span>
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
                                                <label for="width" class=" form-control-label">Front & Reverse Image</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="file" id="frontImage" name="frontImage" placeholder="Select a Front Image..." class="form-control">
                                                <span class="help-block">Please select a Front Image</span>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="file" id="reverseImage" name="reverseImage" placeholder="Select a Reverse Image..." class="form-control">
                                                <span class="help-block">Please select a Front Image</span>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="width" class=" form-control-label">Inscription & Sign Image</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="file" id="inscriptionImage" name="inscriptionImage" placeholder="Select an Inscription Image..." class="form-control">
                                                <span class="help-block">Please select an Inscription Image</span>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="file" id="signImage" name="signImage" placeholder="Select a Sign Image..." class="form-control">
                                                <span class="help-block">Please select a Sign Image</span>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="code_numeration" class=" form-control-label">Numeration Code</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="code_numeration" name="code_numeration" placeholder="Enter Numeration Code" class="form-control">
                                                <span class="help-block">Please enter Numeration Code</span>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="emissionDate" class=" form-control-label">Emission Date & Certificate Date</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="text" id="emissionDate" name="emissionDate" placeholder="Enter Emission Date..." class="form-control">
                                                <span class="help-block">Please enter the Emission Date (YYYY-MM-DD)</span>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="text" id="emissionDateActualCertificate" name="emissionDateActualCertificate" placeholder="Enter Certificate Date..." class="form-control">
                                                <span class="help-block">Please enter the Certificate Date</span>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="othersVertical" class=" form-control-label">Other & Reference</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="text" id="othersVertical" name="othersVertical" placeholder="Vertical Other Notes..." class="form-control">
                                                <span class="help-block">Please enter Vertical Other Notes</span>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <input type="text" id="referenceVertical" name="referenceVertical" placeholder="Enter Vertical References..." class="form-control">
                                                <span class="help-block">Please enter Vertical References</span>
                                            </div>
                                        </div>


                                    
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary btn-sm" id="sendCreateCertificate"> 
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




<!-- CONFIRMATION -->
<div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="confirmationlLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sconfirmationLabel">Small Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <div id="confirmationResponse">The Certificate has been deleted</div>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onClick="reloadWeb('certificates.php')">Close</button>
                
            </div>
        </div>
    </div>
</div>
<!-- END CONFIRMATION-->