<style>.brands{display:none;}</style>   
 <footer class="footer footer-2 footer-3" id="footer-area">
            <!-- Footer Links Starts -->
            <div class="footer-links">
                <!-- Container Starts -->
                <div class="container-fluid">
                    <!-- Contact Us Starts -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
	                    <a href=""><img src="images/logo.jpg" alt="" width="180"></a>
                        
                        <ul>
                            <li class="footer-map">@streetAddress@</li>
                            <li class="footer-email"><a href="mailto:@adminMail@">@adminMail@</a></li>
                        </ul>
                    </div>
                    <!-- Contact Us Ends -->
                    <!-- My Account Links Starts -->
                    <div class="col-md-3  col-sm-6 col-xs-12">
                        <ul>
                            <li><a href="/users/">@UsersLogin@</a></li>
                            <li><a href="/users/order.html">{��������� �����}</a></li>
                            <li><a href="/users/wishlist/">{���������� ������}</a></li>
                            <li><a href="/users/message.html">{����� � �����������}</a></li>
                            @php if($_SESSION['UsersId']) echo '
                            <li><a href="?logout=true">{�����}</a></li>
                            '; php@
                        </ul>
                    </div>
                    <!-- My Account Links Ends -->
                    <div class="clearfix visible-sm"></div>
                    <!-- Customer Service Links Starts -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <ul>
                            @bottomMenu@
                            
                        </ul>
                    </div>
                    <!-- Customer Service Links Ends -->
                    <!-- Information Links Starts -->
                    <div class="col-md-3 col-sm-6 col-xs-12 t-right">
                        
						@sticker_pay@
                      
						@sticker_socfooter@
						@button@
                    </div>
                    <!-- Information Links Ends -->
                </div>

                <!-- Container Ends -->
            </div>
            <!-- Footer Links Ends -->

        </footer>