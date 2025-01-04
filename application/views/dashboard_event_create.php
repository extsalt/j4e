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
                            <a href="/dashboard/events">
                                <button class="btn btn-primary">My Event</button>
                            </a>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-2">
                            <ul class="list-group">
                                <li class="list-group-item">An item</li>
                                <li class="list-group-item">A second item</li>
                                <li class="list-group-item">A third item</li>
                                <li class="list-group-item">A fourth item</li>
                                <li class="list-group-item">And a fifth one</li>
                            </ul>
                        </div>
                        <div class="col-10">
                            <div class="card">
                                <div class="card-body">
                                    Event Form
                                </div>
                            </div>
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