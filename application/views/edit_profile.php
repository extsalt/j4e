<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<!-- START -->
<!--PRICING DETAILS-->
<section class=" ud">
    <div class="ud-inn">
        <!--LEFT SECTION-->
        <?php include 'dashboard_menu.php'; ?><!--CENTER SECTION-->
<div class="ud-main">
   <div class="ud-main-inn ud-no-rhs">

			<div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst">Edit Profile</span>
                                <?php
                                    if($this->session->flashdata('message'))
                                    {
                                ?>
                                <div class="log-suc"><p><?= $this->session->flashdata('message') ?></p></div>
                                <?php
                                    }
                                ?>
<!--                    <div class="log-error use-act-err">
        <p>
            Important: Your Profile has not been activated yet. Once we done your verification, we email you soon when your account is fully activated.        </p>
    </div>-->
                <div class="ud-cen-s2 ud-pro-edit">
                    <h2>About Details</h2>
                    <form id="profile_update" name="profile_update" action="<?= base_url('edit_profile') ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
<!--                                <table class="responsive-table bordered">
                                <tbody>
                                    <tr>
                                        <td>-->
                                    <div class="form-group">
                                        <textarea class="form-control" name="about_company" id="product_description" placeholder="About"><?= $user_info->about_company ?></textarea>
                                    </div>
<!--                                        </td>
                                </tr>
                                </tbody>
                                </table>-->
                                </div>
                            </div>
                            <table class="responsive-table bordered">
                                <tbody>
                                    <tr>
                                        
					<td width="25%">Company Name</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="company" placeholder="Company" value="<?= $user_info->company ?>">
                                            </div>
                                        </td>
                                        <td width="25%">Designation</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="designation" placeholder="Designation" value="<?= $user_info->designation ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Business Entity</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <select class="form-control" name="business_entity">
                                                    <option value="">Select</option>
                                                    <option value="Trust" <?php if($user_info->business_entity == "Trust"){ echo 'selected'; } ?>>Trust</option>
                                                    <option value="Private Ltd" <?php if($user_info->business_entity == "Private Ltd"){ echo 'selected'; } ?>>Private Ltd</option>
                                                    <option value="Partnership" <?php if($user_info->business_entity == "Partnership"){ echo 'selected'; } ?>>Partnership</option>
                                                    <option value="Public Ltd" <?php if($user_info->business_entity == "Public Ltd"){ echo 'selected'; } ?>>Public Ltd</option>
                                                    <option value="Properitiorship" <?php if($user_info->business_entity == "Properitiorship"){ echo 'selected'; } ?>>Properitiorship</option>
                                                    <option value="LLP" <?php if($user_info->business_entity == "LLP"){ echo 'selected'; } ?>>LLP</option>
                                                    <option value="NGO" <?php if($user_info->business_entity == "NGO"){ echo 'selected'; } ?>>NGO</option>
                                                </select>
                                            </div>
                                        </td>
					<td width="25%">Business Type</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <select class="form-control" name="business_type">
                                                    <option value="">Select</option>
                                                    <option value="Business to Business (B2B)" <?php if($user_info->business_type == "Business to Business (B2B)"){ echo 'selected'; } ?>>Business to Business (B2B)</option>
                                                    <option value="Business to Consumer (B2C)" <?php if($user_info->business_type == "Business to Consumer (B2C)"){ echo 'selected'; } ?>>Business to Consumer (B2C)</option>
                                                    <option value="Business to Government (B2G)" <?php if($user_info->business_type == "Business to Government (B2G)"){ echo 'selected'; } ?>>Business to Government (B2G)</option>
                                                    
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Business Expertise</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <select class="form-control" name="business_experties">
                                                    <option value="">Select</option>
                                                    <option value="Agriculture" <?php if($user_info->business_experties == "Agriculture"){ echo 'selected'; } ?>>Agriculture</option>
                                                    <option value="Other" <?php if($user_info->business_experties == "Other"){ echo 'selected'; } ?>>Other</option>
                                                    <option value="Manufacturer" <?php if($user_info->business_experties == "Manufacturer"){ echo 'selected'; } ?>>Manufacturer</option>
                                                    <option value="Services" <?php if($user_info->business_experties == "Services"){ echo 'selected'; } ?>>Services</option>
                                                    <option value="Products" <?php if($user_info->business_experties == "Products"){ echo 'selected'; } ?>>Products</option>
                                                    <option value="Trader" <?php if($user_info->business_experties == "Trader"){ echo 'selected'; } ?>>Trader</option>
                                                    
                                                </select>
                                            </div>
                                        </td>
					<td width="25%">No. of Employees</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <select class="form-control" name="no_of_employees">
                                                    <option value="">Select</option>
                                                    <?php
                                                        $employee_info = $this->db->get('employee')->result();
                                                        if(!empty($employee_info))
                                                        {
                                                            foreach($employee_info as $val)
                                                            {
                                                    ?>
                                                    <option value="<?= $val->id ?>" <?php if($user_info->no_of_employees == $val->id){ echo 'selected'; } ?>><?= $val->title ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>                                       
					<td width="25%">Expected Turnover</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <select class="form-control" name="turn_over">
                                                    <option value="">Select</option>
                                                    <?php
                                                        $turn_over_info = $this->db->get('turn_over')->result();
                                                        if(!empty($turn_over_info))
                                                        {
                                                            foreach($turn_over_info as $val)
                                                            {
                                                    ?>
                                                    <option value="<?= $val->turn_over_id ?>" <?php if($user_info->turn_over == $val->turn_over_id){ echo 'selected'; } ?>><?= $val->turn_over_value ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td width="25%">Business Category</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <select class="form-control" name="business_category">
                                                    <option value="">Select</option>
                                                    <?php
                                                        $business_category_info = $this->db->get('tbl_functional_area')->result();
                                                        if(!empty($business_category_info))
                                                        {
                                                            foreach($business_category_info as $val)
                                                            {
                                                    ?>
                                                    <option value="<?= $val->functional_area_id ?>" <?php if($user_info->business_category == $val->functional_area_id){ echo 'selected'; } ?>><?= $val->functional_area ?></option>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Working From</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="working_from" placeholder="Working From" value="<?= $user_info->working_from ?>">
                                            </div>
                                        </td>
					<td width="25%">Who is your Target Audiance</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="target_audiance" placeholder="Who is your Target Audiance" value="<?= $user_info->target_audiance ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        
					<td width="25%">Your total year of Experience</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="total_experience" placeholder="Your total year of Experience" value="<?= $user_info->total_experience ?>">
                                            </div>
                                        </td>
                                        <td width="25%">Gender</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <select class="form-control" name="gender">
                                                    <option value="">Select</option>
                                                    <option value="Male" <?php if($user_info->gender == "Male"){ echo 'selected'; } ?>>Male</option>
                                                    <option value="Female" <?php if($user_info->gender == "Female"){ echo 'selected'; } ?>>Female</option>
                                                    
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Profile Picture</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <div class="fil-img-uplo">
                                                    <span class="dumfil">Upload a file</span>
                                                    <input type="file" name="avatar" accept=".jpg,.jpeg,.png" class="form-control">
                                                    <?php
                                                        if(!empty($user_info->avatar))
                                                        {
                                                            echo '<br><a href="'.  base_url('admin/upload/avatar/'.$user_info->avatar).'" download>Download<a>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>                                      
                                        </td>
					<td width="25%">Company Brochure</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <div class="fil-img-uplo">
                                                    <span class="dumfil">Upload a file</span>
                                                    <input type="file" name="company_profile" accept=".pdf" class="form-control">
                                                    <?php
                                                        if(!empty($user_info->company_profile))
                                                        {
                                                            echo '<br><a href="'.  base_url('admin/upload/requirements/'.$user_info->company_profile).'" download>Download<a>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>                                      
                                        </td>
                                    </tr>                              
                                </tbody>
                            </table>
                        <button type="submit" name="about_details" class="db-pro-bot-btn">Save Changes</button>
                    </form>
                </div>
                <div class="ud-cen-s2 ud-pro-edit">
                    <h2>Contact Details</h2>
                    <form id="profile_update" name="profile_update" action="<?= base_url('edit_profile') ?>" method="post" enctype="multipart/form-data">
                        
                            <table class="responsive-table bordered">
                                <tbody>
                                    <tr>
                                        <td width="25%">Email</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email_address" placeholder="Email" value="<?= $user_info->email_address ?>">
                                            </div>
                                        </td>
					<td width="25%">Phone Number</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone" placeholder="Phone Number" value="<?= $user_info->phone ?>" readonly="">
                                            </div>
                                        </td>
                                    </tr>    
                                    <tr>
                                        <td width="25%">WhatsApp Phone Number</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control numinput" name="wmobile" placeholder="WhatsApp Phone Number" value="<?= $user_info->wmobile ?>">
                                            </div>
                                        </td>
					<td width="25%">WhatsApp Business Phone Number</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control numinput" name="company_wmobile" placeholder="WhatsApp Business Phone Number" value="<?= $user_info->company_wmobile ?>" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Website</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="website" placeholder="Website" value="<?= $user_info->website ?>">
                                            </div>
                                        </td>
					<td width="25%">Location</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="company_address" placeholder="Location" value="<?= $user_info->company_address ?>" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Date of Birth</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="dob" value="<?= $user_info->dob ?>">
                                            </div>
                                        </td>
					<td width="25%">Google Link</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="company_google" placeholder="Google Link" value="<?= $user_info->company_google ?>" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Facebook Link</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="company_facebook" placeholder="Facebook Link" value="<?= $user_info->company_facebook ?>" >
                                            </div>
                                        </td>
					<td width="25%">Linkedin Link</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="company_linkedin" placeholder="Linkedin Link" value="<?= $user_info->company_linkedin ?>" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Vcard Front</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <div class="fil-img-uplo">
                                                    <span class="dumfil">Upload a file</span>
                                                    <input type="file" name="vcard_front" accept=".jpg,.jpeg,.png" class="form-control">
                                                    <?php
                                                        if(!empty($user_info->vcard_front))
                                                        {
                                                            echo '<br><a href="'.  base_url('admin/upload/requirements/'.$user_info->vcard_front).'" download>Download<a>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>                                      
                                        </td>
					<td width="25%">Vcard Back</td>
                                        <td width="25%">
                                            <div class="form-group">
                                                <div class="fil-img-uplo">
                                                    <span class="dumfil">Upload a file</span>
                                                    <input type="file" name="vcard_back" accept=".jpg,.jpeg,.png" class="form-control">
                                                    <?php
                                                        if(!empty($user_info->vcard_back))
                                                        {
                                                            echo '<br><a href="'.  base_url('admin/upload/requirements/'.$user_info->vcard_back).'" download>Download<a>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>                                      
                                        </td>
                                    </tr>   
                                </tbody>
                            </table>
                        <button type="submit" name="contact_details" class="db-pro-bot-btn">Save Changes</button>
                    </form>
                </div>
                <div class="ud-cen-s2 ud-pro-edit">
                    <h2>Gallery</h2>
                    <form id="profile_update" name="profile_update" action="<?= base_url('edit_profile') ?>" method="post" enctype="multipart/form-data">
                        
                            <div class="row">
                                        <?php
                                            $gallery_info = $this->db->where(array('gallery_type'=>1,'user_id'=>$user_info->id,'status'=>1))->get('gallery')->result();
                                            if(!empty($gallery_info))
                                            {
                                                
                                                foreach($gallery_info as $val)
                                                {
                                        ?>
                                        <div class="col-md-2">
                                            <img src="<?= base_url('admin/upload/gallery/profile/'.$val->image) ?>" style="width: 100%;height: 100px;">
                                            <br><br>
                                            <center><a href="<?= base_url('home/delete_gallery_image/'.$val->id) ?>" class="db-list-edit">Delete</a></center>
                                        </div>
                                        <?php
                                                    
                                                }
                                            }
                                        ?>
                                 
                            </div>       
                        <br>
                        <?php
                            $recommendation = 0;
                                $check_in_usertble = $this->db->where('id',$this->session->userdata('userid'))->get('user')->row();
                                $pf_info = $this->db->where(array('package_id'=>$check_in_usertble->packages_id,'feature_id'=>5))->get('package_features')->row();
                                $package_info = $this->db->where(array('user_id'=>$check_in_usertble->id,'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                $user_consumption = $this->db->where(array('user_id'=>$check_in_usertble->id,'package_id'=>$check_in_usertble->packages_id,'feature_id'=>5,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
            
                                if($pf_info->count_allowed > 0)
                                {                                   
                                    if(!empty($user_consumption))
                                    {
                                       if($user_consumption->used_count == $pf_info->count_allowed)
                                       {
                                           $recommendation = 1;
                                       }
                                    }                                   
                                }
                                if($recommendation == 0)
                                {
                        ?>
                             <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <!--<label>Product images(max 5 images)</label>-->
                                                <div class="fil-img-uplo">
                                                    <span class="dumfil">Upload a file</span>
                                                    <input type="file" name="gallery_image[]" accept="image/*,.jpg,.jpeg,.png" class="form-control" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>       
                        <button type="submit" name="gallery_details" class="db-pro-bot-btn">Save Changes</button>
                        <?php
                                }
                        ?>
                    </form>
                </div>
            </div>
</div>
</div>
</section>
<!--END PRICING DETAILS-->
<!-- START -->


   <?php include 'footer.php'; ?>     