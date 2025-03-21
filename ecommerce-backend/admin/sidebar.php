<?php
$current_page = basename($_SERVER['PHP_SELF']); // Get current page filename
?>

<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            <li class="nav-item <?= ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                <a href="./dashboard.php" class="nav-link nav-toggle">
                    <i class="glyphicon glyphicon-th-large"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="heading">
                <h3 class="uppercase">Features</h3>
            </li>

            <li class="nav-item <?= ($current_page == 'orders.php') ? 'active' : ''; ?>">
                <a href="./orders.php" class="nav-link nav-toggle">
                    <i class="glyphicon glyphicon-list"></i>
                    <span class="title">Orders</span>
                </a>
            </li>

            <li class="nav-item <?= in_array($current_page, ['brandlist.php', 'categorylist.php', 'sub_categorylist.php', 'productlist.php', 'customerlist.php', 'coupon_codelist.php']) ? 'active' : ''; ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="glyphicon glyphicon-th-large"></i>
                    <span class="title">Master</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= ($current_page == 'brandlist.php') ? 'active' : ''; ?>">
                        <a href="./brandlist.php" class="nav-link">
                            <span class="title">Brand</span>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_page == 'categorylist.php') ? 'active' : ''; ?>">
                        <a href="./categorylist.php" class="nav-link">
                            <span class="title">Category</span>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_page == 'sub_categorylist.php') ? 'active' : ''; ?>">
                        <a href="./sub_categorylist.php" class="nav-link">
                            <span class="title">Sub Category</span>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_page == 'productlist.php') ? 'active' : ''; ?>">
                        <a href="./productlist.php" class="nav-link">
                            <span class="title">Product</span>
                        </a>
                    </li>
                    <!-- State Menu -->
                    <li class="nav-item <?= in_array($current_page, ['addstate.php', 'statelist.php']) ? 'active' : ''; ?>">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <span class="title">State</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item <?= ($current_page == 'addstate.php') ? 'active' : ''; ?>">
                                <a href="./addstate.php" class="nav-link">
                                    <span class="title">Add State</span>
                                </a>
                            </li>
                            <li class="nav-item <?= ($current_page == 'statelist.php') ? 'active' : ''; ?>">
                                <a href="./statelist.php" class="nav-link">
                                    <span class="title">List of States</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- City Menu -->
                    <li class="nav-item <?= in_array($current_page, ['addcity.php', 'citylist.php']) ? 'active' : ''; ?>">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <span class="title">City</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item <?= ($current_page == 'addcity.php') ? 'active' : ''; ?>">
                                <a href="./addcity.php" class="nav-link">
                                    <span class="title">Add City</span>
                                </a>
                            </li>
                            <li class="nav-item <?= ($current_page == 'citylist.php') ? 'active' : ''; ?>">
                                <a href="./citylist.php" class="nav-link">
                                    <span class="title">List of Cities</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= ($current_page == 'customerlist.php') ? 'active' : ''; ?>">
                        <a href="./customerlist.php" class="nav-link">
                            <span class="title">Customer</span>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_page == 'coupon_codelist.php') ? 'active' : ''; ?>">
                        <a href="./coupon_codelist.php" class="nav-link">
                            <span class="title">Coupon Code</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item <?= ($current_page == 'bulk_price_change.php') ? 'active' : ''; ?>">
                <a href="./bulk_price_change.php" class="nav-link">
                    <i class="glyphicon glyphicon-list"></i>
                    <span class="title">Bulk Price Change</span>
                </a>
            </li>

            <li class="nav-item <?= ($current_page == 'expense.php' || $current_page == 'passbook.php') ? 'active' : ''; ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="glyphicon glyphicon-th-large"></i>
                    <span class="title">Account</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= ($current_page == 'expense.php') ? 'active' : ''; ?>">
                        <a href="./expense.php" class="nav-link">
                            <span class="title">Expense</span>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_page == 'passbook.php') ? 'active' : ''; ?>">
                        <a href="./passbook.php" class="nav-link">
                            <span class="title">Passbook</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Place Order Menu -->
            <li class="nav-item <?= in_array($current_page, ['copy_order.php', 'new_order.php']) ? 'active' : ''; ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="glyphicon glyphicon-edit"></i>
                    <span class="title">Place Order</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= ($current_page == 'copy_order.php') ? 'active' : ''; ?>">
                        <a href="./copy_order.php" class="nav-link">
                            <span class="title">Copy Order</span>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_page == 'new_order.php') ? 'active' : ''; ?>">
                        <a href="./new_order.php" class="nav-link">
                            <span class="title">New Order</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Report -->
            <!-- <li class="nav-item <?= ($current_page == 'delivery_route_based_report.php' || $current_page == 'delivery_collection_report.php') ? 'active' : ''; ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="glyphicon glyphicon-list"></i>
                    <span class="title">Report</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= ($current_page == 'delivery_route_based_report.php') ? 'active' : ''; ?>">
                        <a href="./delivery_route_based_report.php" class="nav-link">
                            <i class="glyphicon glyphicon-map-marker"></i>
                            <span class="title">Route Based Report</span>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_page == 'delivery_collection_report.php') ? 'active' : ''; ?>">
                        <a href="./delivery_collection_report.php" class="nav-link">
                            <i class="glyphicon glyphicon-list-alt"></i>
                            <span class="title">Delivery Collection Report</span>
                        </a>
                    </li>
                </ul>
            </li> -->

            <li class="nav-item <?= in_array($current_page, ['sms_transaction.php', 'sms_promotional.php']) ? 'active' : ''; ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="glyphicon glyphicon-envelope"></i>
                    <span class="title">SMS</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= ($current_page == 'sms_transaction.php') ? 'active' : ''; ?>">
                        <a href="./sms_transaction.php" class="nav-link">
                            <span class="title">Transaction SMS</span>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_page == 'sms_promotional.php') ? 'active' : ''; ?>">
                        <a href="./sms_promotional.php" class="nav-link">
                            <span class="title">Promotional SMS</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item <?= ($current_page == 'offers_banner_list.php') ? 'active' : ''; ?>">
                <a href="./offers_banner_list.php" class="nav-link">
                    <i class="glyphicon glyphicon-gift"></i>
                    <span class="title">Offers Banner</span>
                </a>
            </li>

            <li class="nav-item <?= ($current_page == 'blog.php') ? 'active' : ''; ?>">
                <a href="./blog.php" class="nav-link">
                    <i class="glyphicon glyphicon-edit"></i>
                    <span class="title">Blog</span>
                </a>
            </li>

            <li class="nav-item <?= ($current_page == 'marketing_tag.php') ? 'active' : ''; ?>">
                <a href="./marketing_tag.php" class="nav-link">
                    <i class="glyphicon glyphicon-th"></i>
                    <span class="title">Marketing Tag</span>
                </a>
            </li>

            <li class="nav-item <?= ($current_page == 'contact.php') ? 'active' : ''; ?>">
                <a href="./contact.php" class="nav-link">
                    <i class="glyphicon glyphicon-phone"></i>
                    <span class="title">Contact</span>
                </a>
            </li>

            <!-- Delivery Time Slot Menu -->
            <li class="nav-item <?= ($current_page == 'delivery_time_slot.php') ? 'active' : ''; ?>">
                <a href="./delivery_time_slot.php" class="nav-link">
                    <i class="glyphicon glyphicon-map-marker"></i>
                    <span class="title">Delivery Time Slot</span>
                </a>
            </li>

            <!-- Notification -->
            <!-- <li class="nav-item <?= ($current_page == 'notification.php') ? 'active' : ''; ?>">
                <a href="./notification.php" class="nav-link">
                    <i class="glyphicon glyphicon-bell"></i>
                    <span class="title">Notification</span>
                </a>
            </li> -->

            <!-- Delivery Route -->
            <!-- <li class="nav-item <?= ($current_page == 'delivery_boy.php') ? 'active' : ''; ?>">
                <a href="./delivery_boy.php" class="nav-link">
                    <i class="fa fa-truck"></i>
                    <span class="title">Delivery Route</span>
                </a>
            </li> -->

            <li class="nav-item <?= ($current_page == 'change_password.php') ? 'active' : ''; ?>">
                <a href="./change_password.php" class="nav-link">
                    <i class="fa fa-lock"></i>
                    <span class="title">Change Password</span>
                </a>
            </li>

            <!-- Point Transaction -->
            <li class="nav-item <?= ($current_page == 'point_transaction.php') ? 'active' : ''; ?>">
                <a href="./point_transaction.php" class="nav-link">
                    <i class="glyphicon glyphicon-sort"></i>
                    <span class="title">Point Transaction</span>
                </a>
            </li>

            <!-- Product Inquiry -->
            <li class="nav-item <?= ($current_page == 'product_inquiry.php') ? 'active' : ''; ?>">
                <a href="./product_inquiry.php" class="nav-link">
                    <i class="glyphicon glyphicon-bullhorn"></i>
                    <span class="title">Product Inquiry</span>
                </a>
            </li>

            <!-- Product Review -->
            <li class="nav-item <?= ($current_page == 'product_review.php' || $current_page == 'product_review_approved.php' || $current_page == 'product_review_pending.php') ? 'active' : ''; ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="glyphicon glyphicon-star"></i>
                    <span class="title">Product Review</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?= ($current_page == 'product_review.php') ? 'active' : ''; ?>">
                        <a href="./product_review.php" class="nav-link">
                            <i class="glyphicon glyphicon-list"></i>
                            <span class="title">All</span>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_page == 'product_review_approved.php') ? 'active' : ''; ?>">
                        <a href="./product_review_approved.php" class="nav-link">
                            <i class="glyphicon glyphicon-check"></i>
                            <span class="title">Approved</span>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_page == 'product_review_pending.php') ? 'active' : ''; ?>">
                        <a href="./product_review_pending.php" class="nav-link">
                            <i class="glyphicon glyphicon-time"></i>
                            <span class="title">Pending</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Important Links -->
            <li class="nav-item <?= ($current_page == 'important_links.php') ? 'active' : ''; ?>">
                <a href="./important_links.php" class="nav-link">
                    <i class="glyphicon glyphicon-edit"></i>
                    <span class="title">Important Links</span>
                </a>
            </li>

            <li class="nav-item <?= ($current_page == 'setting.php') ? 'active' : ''; ?>">
                <a href="./setting.php" class="nav-link">
                    <i class="glyphicon glyphicon-cog"></i>
                    <span class="title">Setting</span>
                </a>
            </li>

            <!-- Generate Ticket -->
            <!-- <li class="nav-item <?= ($current_page == 'generate_ticket.php') ? 'active' : ''; ?>">
                <a href="./generate_ticket.php" class="nav-link">
                    <i class="glyphicon glyphicon-comment"></i>
                    <span class="title">Generate Ticket</span>
                </a>
            </li> -->
        </ul>
    </div>
</div>