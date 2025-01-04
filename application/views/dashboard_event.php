<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<section class=" ud">
    <div class="ud-inn">
        <?php include 'dashboard_menu.php'; ?>
        <div class="ud-main">
            <div class="ud-main-inn">
                <div class="js-dashboard-container mt-5">
                    <div class="js-event-toolbar-container d-flex justify-content-end">
                        <div class="js-event-toolbar">
                            <a href="/dashboard/events/create">
                                <button class="btn btn-primary">Create Event</button>
                            </a>
                        </div>
                    </div>
                    <div class="js-event-table my-4 border-1">
                        <div class="row ">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button class="btn btn-link font-weight-bold js-event-tab-selector-btn" data-target=".js-event-status-active"> Active Event </button>
                                    </div>
                                    <div>
                                        <button class="btn btn-link font-weight-bold js-event-tab-selector-btn" data-target=".js-event-status-past"> Past Event </button>
                                    </div>
                                    <div>
                                        <button class="btn btn-link font-weight-bold js-event-tab-selector-btn" data-target=".js-event-status-draft"> Draft Event </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row js-event-status-active">
                            active
                        </div>
                        <div class="row js-event-status-past d-none">
                            past
                        </div>
                        <div class="row js-event-status-draft d-none">
                            draft
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
<script>
    $(document).ready(function() {
        $('.js-event-tab-selector-btn').on('click', function() {
            var target = $(this).data('target');
            var targets = ['.js-event-status-active', '.js-event-status-past', '.js-event-status-draft'];
            targets.forEach(function(el) {
                if (el == target) {
                    $(el).removeClass('d-none');
                } else {
                    $(el).addClass('d-none');
                }
            })
        });
    });
</script>