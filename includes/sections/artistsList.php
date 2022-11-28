<!-- DATA TABLE-->
<section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-5 m-b-35">Artists List</h3>
                            <?php if ($messageConfirmation) { ?><h6><font color='red'><center><?php echo $messageConfirmation ?></center></font></h6><?php } ?>
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                     
                                    <form action="artists.php" method="GET">
                                    
                                    <div class="row form-group">
                                        <div class="col col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary">
                                                        <i class="fa fa-search"></i> Search
                                                    </button>
                                                </div>
                                                <input type="text" id="searchArtist" name="searchArtist" placeholder="Artist to search" value="<?php echo $_GET['searchArtist'] ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="table-data__tool-right">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" type="button" data-toggle="modal" data-target="#createArtist">
                                        <i class="zmdi zmdi-plus"></i>create artist</button>
                                    
                                </div>
                            </div>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>
                                                artistId
                                            </th>
                                            <th>name</th>
                                            <th>last name</th>
                                            <th>email</th>
                                            <th>birthday</th>
                                            <th>website</th>
                                            
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                           
                                            if ($_GET['searchArtist']) {
                                                $sqlExtraArtist = " WHERE (authors.lastname like('%%".$_REQUEST['searchArtist']."%%') OR  authors.email like('%%".$_REQUEST['searchArtist']."%%') OR authors.website like('%%".$_REQUEST['searchArtist']."%%')) ";
                                            }

                                            $sql = "SELECT 
                                            authors.authorId,
                                            authors.name,
                                            authors.lastname,
                                            authors.email,
                                            authors.birthday,
                                            authors.website
                                             FROM authors 
                                             ".$sqlExtraArtist." ORDER by authorId ASC limit 0,30";
                                            $res = mysqli_query($conn, $sql);
                                            $rows = mysqli_num_rows($res);
                                            
                                            while($dat=mysqli_fetch_array($res)) {
                                                
                                                
                                        ?>
                                        <tr class="tr-shadow">
                                            <td><?php echo $dat[0] ?></td>
                                            <td><?php echo $dat[1] ?></td>
                                            <td class="desc"><?php echo $dat[2] ?></td>
                                            <td><span class="block-email"><?php echo $dat[3] ?></span></td>
                                            
                                            <td><?php echo $dat[4] ?></td>
                                            <td><span class="status--process"><?php echo $dat[5] ?></span></td>
                                            
                                            <td>
                                                <div class="table-data-feature">
                                                    <button class="item" onClick="editAuthor(<?php echo $dat[0] ?>)" data-placement="top" title="Edit"  >
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" onClick="deleteAuthor(<?php echo $dat[0] ?>);">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                   
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
                                                            No Artists to show
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
            <!-- CREATE A NEW ARTIST-->
            <div class="modal fade" id="createArtist" tabindex="-1" role="dialog" aria-labelledby="createArtistLabel" aria-hidden="true">
                
                <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
                        <form method="POST" action="artists.php" id="formCreateArtist" class="form-horizontal">
                            <input type="hidden" name="action" value="createArtist">
                        
                            <div class="modal-header">
                                <h5 class="modal-title" id="createArtistLabel">Create a new Artist / Author</h5>
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
                                                        <label for="artistName" class=" form-control-label">Name</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" id="artistName" name="artistName" placeholder="Enter Artist Name..." class="form-control">
                                                        <span class="help-block">Please enter Artist Name</span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="artistLastName" class=" form-control-label">Last Name</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" id="artistLastName" name="artistLastName" placeholder="Enter Artist Last Name..." class="form-control">
                                                        <span class="help-block">Please enter Artist Last Name</span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="artistEmail" class=" form-control-label">E-Mail</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="email" id="artistEmail" name="artistEmail" placeholder="Enter Artist E-Mail..." class="form-control">
                                                        <span class="help-block">Please enter Artist E-Mail</span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="artistBirthDay" class=" form-control-label">BirthDay</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" id="artistBirthDay" name="artistBirthDay" placeholder="Enter Artist BirthDay..." class="form-control">
                                                        <span class="help-block">YYYY-MM-DD</span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="artistWebsite" class=" form-control-label">WebSite</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" id="artistWebsite" name="artistWebsite" placeholder="Enter Artist WebSite..." class="form-control">
                                                        <span class="help-block">Please enter Artist WenSite</span>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-primary btn-sm" id="sendCreateArtist"> 
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
            <!-- END CREATE A NEW ARTIST-->



            <!-- EDIT AN ARTIST-->
            <div class="modal fade" id="editArtist" tabindex="-1" role="dialog" aria-labelledby="editArtistLabel" aria-hidden="true">
                
                <div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
                        <form method="POST" action="artists.php" id="formEditArtist" class="form-horizontal">
                            <input type="hidden" name="action" value="editArtist">
                            <input type="hidden" name="authorIdEdit" id="authorIdEdit">
                        
                            <div class="modal-header">
                                <h5 class="modal-title" id="editArtistLabel">Edit an Artist / Author</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    <div id="errorFormEdit"></div>

                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Complete the Form</strong>
                                        </div>
                                        <div class="card-body card-block">
                                           
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="artistNameEdit" class=" form-control-label">Name</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" id="artistNameEdit" name="artistNameEdit" placeholder="Enter Artist Name..." class="form-control">
                                                        <span class="help-block">Please enter Artist Name</span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="artistLastNameEdit" class=" form-control-label">Last Name</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" id="artistLastNameEdit" name="artistLastNameEdit" placeholder="Enter Artist Last Name..." class="form-control">
                                                        <span class="help-block">Please enter Artist Last Name</span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="artistEmailEdit" class=" form-control-label">E-Mail</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="email" id="artistEmailEdit" name="artistEmailEdit" placeholder="Enter Artist E-Mail..." class="form-control">
                                                        <span class="help-block">Please enter Artist E-Mail</span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="artistBirthDayEdit" class=" form-control-label">BirthDay</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" id="artistBirthDayEdit" name="artistBirthDayEdit" placeholder="Enter Artist BirthDay..." class="form-control">
                                                        <span class="help-block">YYYY-MM-DD</span>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="artistWebsiteEdit" class=" form-control-label">WebSite</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" id="artistWebsiteEdit" name="artistWebsiteEdit" placeholder="Enter Artist WebSite..." class="form-control">
                                                        <span class="help-block">Please enter Artist WebSite</span>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-primary btn-sm" id="sendEditArtist"> 
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
            <!-- END CREATE A NEW ARTIST-->
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
								<div id="confirmationResponse">The Artist has been deleted</div>
							</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" onClick="reloadWeb('artists.php')">Close</button>
							
						</div>
					</div>
				</div>
			</div>
            <!-- END CONFIRMATION-->

