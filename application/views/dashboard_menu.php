<?php
$user_info = $this->db->where('id', $this->session->userdata('userid'))->get('user')->row();
?>
<div class="ud-lhs">
    <div class="ud-lhs-s1">
        <img
            src="<?= base_url('admin/upload/avatar/' . $user_info->avatar) ?>" alt="" loading="lazy">
        <div class="ud-lhs-pro-bio">
            <h4><?= $user_info->first_name . " " . $user_info->last_name ?></h4>
            <b>Join on <?= date('d, M Y', strtotime($user_info->created_time)) ?></b>
            <a class="ud-lhs-view-pro" target="_blank"
                href="<?= base_url('member_profile/' . $user_info->id) ?>">My Profile</a>
        </div>
    </div>
    <div class="ud-lhs-s2">
        <ul>
            <li>
                <a href="<?= base_url('dashboard') ?>" class="db-lact"><img src="<?= base_url('assets/') ?>images/icon/dbl1.png"
                        alt="" /> My Dashboard</a>
            </li>

            <li>
                <h4>Events</h4>
                <a href="/dashboard/events" class=""> <img src="<?= base_url('assets/') ?>images/icon/dbl9.png" alt="" loading="lazy">Events</a>
            </li>

            <li>
                <h4>Payment & Promotions</h4>
                <a href="<?= base_url('payments') ?>"
                    class=""><img src="<?= base_url('assets/') ?>images/icon/dbl9.png"
                        alt="" loading="lazy">Payment & plan</a>
            </li>

            <li>
                <a href="<?= base_url('point_history') ?>"
                    class=""><img src="<?= base_url('assets/') ?>images/icon/point.png"
                        alt="" />Points History</a>
            </li>


            <li>
                <h4>Profile pages</h4>
                <a href="<?= base_url('edit_profile') ?>"
                    class=""><img src="<?= base_url('assets/') ?>images/icon/profile.png"
                        alt="" />Edit Profile</a>
            </li>

            <li>
                <a href="<?= base_url('logout') ?>"><img src="<?= base_url('assets/') ?>images/icon/dbl12.png"
                        alt="" />Log Out</a>
            </li>
        </ul>
    </div>
</div><!--CENTER SECTION-->