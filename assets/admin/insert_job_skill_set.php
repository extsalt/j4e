<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

include "config/info.php";
if (isset($_POST['category_submit'])) {

    $cnt = count($_POST['category_name']);
    $cnt2 = count($_POST['category_image']);

// *********** if Count of category name is zero means redirect starts ********

    if ($cnt == 0) {
        header('Location: admin-add-new-job-skill-set.php');
        exit;
    }

// *********** if Count of category name is zero means redirect ends ********

    for ($i = 0; $i < $cnt; $i++) {

        $category_name = $_POST['category_name'][$i];

        $category_status = "Active";

        $category_filter_pos_id = 1;


//************ Skill Name Already Exist Check Starts ***************


        $category_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "job_skill  WHERE category_name='" . $category_name . "' ");

        if (mysqli_num_rows($category_name_exist_check) > 0) {


            $_SESSION['status_msg'] = "The Given Skill name $category_name is Already Exist Try Other!!!";

            header('Location: admin-add-new-job-skill-set.php');
            exit;


        }

//************ Skill Name Already Exist Check Ends ***************


        $_FILES['category_image']['name'][$i];

        if (!empty($_FILES['category_image']['name'][$i])) {
            $file = rand(1000, 100000) . $_FILES['category_image']['name'][$i];
            $file_loc = $_FILES['category_image']['tmp_name'][$i];
            $file_size = $_FILES['category_image']['size'][$i];
            $file_type = $_FILES['category_image']['type'][$i];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/services/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $event_image);
                $category_image = compressImage($event_image, $file_loc, $folder, $new_size);
            } else {
                $category_image = '';
            }
        }
        if ($i == 0) {
            function checkJobSkillSlug($link, $counter = 1)
            {
                global $conn;
                $newLink = $link;
                do {
                    $checkLink = mysqli_query($conn, "SELECT category_id FROM " . TBL . "job_skill WHERE category_slug = '$newLink'");
                    if (mysqli_num_rows($checkLink) > 0) {
                        $newLink = $link . '' . $counter;
                        $counter++;
                    } else {
                        break;
                    }
                } while (1);

                return $newLink;
            }
        }


        $category_name1 = trim(preg_replace('/[^A-Za-z0-9]/', ' ', $category_name));
        if ($i == 0) {
            $category_slug = checkJobSkillSlug($category_name1);
        } else {
            $category_slug = $category_name1;
        }

        $sql = mysqli_query($conn, "INSERT INTO  " . TBL . "job_skill (category_name,category_status,category_image,category_filter_pos_id,category_slug,category_cdt)
VALUES ('$category_name','$category_status','$category_image','$category_filter_pos_id', '$category_slug', '$curDate')");

        $LID = mysqli_insert_id($conn);
        $lastID = $LID;

        switch (strlen($LID)) {
            case 1:
                $LID = '00' . $LID;
                break;
            case 2:
                $LID = '0' . $LID;
                break;
            default:
                $LID = $LID;
                break;
        }

        $CATID = 'CAT' . $LID;

        $upqry = mysqli_query($conn, "UPDATE " . TBL . "job_skill 
					  SET category_code = '$CATID' 
					  WHERE category_id = $lastID");

    }


    if ($upqry) {

        $_SESSION['status_msg'] = "Job Skill(s) has been Added Successfully!!!";


        header('Location: admin-all-job-skill-set.php');
        exit;

    } else {


        $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

        header('Location: admin-add-new-job-skill-set.php');
        exit;
    }

}
?>