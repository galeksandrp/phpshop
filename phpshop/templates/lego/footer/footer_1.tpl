<footer class="footer footer-1 footer-3" id="footer-area">
    <!-- Footer Links Starts -->
    <div class="footer-links">
        <!-- Container Starts -->
        <div class="container-fluid">
            <!-- Contact Us Starts -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <h5>{��������}</h5>
                <ul>
                    <li class="footer-map">@streetAddress@</li>
                    <li class="footer-email"><a href="mailto:@adminMail@">@adminMail@</a></li>
                     <li class="footer-map">@telNum2@</li>
                    <li class="footer-map">@workingTime@</li>
                </ul>
                @sticker_socfooter@
                @sticker_pay@


            </div>
            <!-- Contact Us Ends -->
            <!-- My Account Links Starts -->
            <div class="col-md-3  col-sm-6 col-xs-12">
                <h5>{��� �������}</h5>
                <ul>
                    <li><a href="/users/">@UsersLogin@</a></li>
                    <li><a href="/users/order.html">{��������� �����}</a></li>
                    <li><a href="/users/wishlist/">{���������� ������}</a></li>

                    @php if($_SESSION['UsersId']) echo '
                    <li><a href="/users/message.html">{����� � �����������}</a></li>
                    <li><a href="?logout=true">{�����}</a></li>
                    '; php@
                </ul>
            </div>
            <!-- My Account Links Ends -->
            <div class="clearfix visible-sm"></div>
            <!-- Customer Service Links Starts -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <h5>{����}</h5>
                <ul>
                    <li><a href="/price/" title="�����-����">{�����-����}</a></li>
                    <li><a href="/news/" title="�������">{�������}</a></li>
                    <li><a href="/gbook/" title="������">{������}</a></li>
                    <li><a href="/map/" title="����� �����">{����� �����}</a></li>
                    <li><a href="/forma/" title="����� �����">{����� �����}</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12 t-right">
                <h5>{����������}</h5>
                <ul>
                    @bottomMenu@

                </ul>
                @button@
            </div>



            <!-- Customer Service Links Ends -->

        </div>

        <!-- Container Ends -->
    </div>
    <!-- Footer Links Ends -->

</footer>