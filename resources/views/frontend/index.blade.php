@extends("frontend.master")

@section("content")


  <div class="col-md-9">
    <?php
            switch ($component) {
                  case "trang-chu":                                                
                        ?>@include("frontend.home")<?php
                        break; 
                  case "danh-muc":                                                
                        ?>@include("frontend.category")<?php
                        break; 
                  case "san-pham":                                                
                        ?>@include("frontend.product")<?php
                        break;
                  case "gio-hang":                                                
                        ?>@include("frontend.cart")<?php
                        break; 
                  case "dang-ky":                                                
                        ?>@include("frontend.register")<?php
                        break;
                  case "tai-khoan":                                                
                        ?>@include("frontend.account")<?php
                        break;
                  case "dang-nhap":                                                
                        ?>@include("frontend.login")<?php
                        break;
                  case "bao-mat":                                                
                        ?>@include("frontend.security")<?php
                        break;
                  case "xac-nhan-thanh-toan":                                                
                        ?>@include("frontend.confirm-checkout")<?php
                        break;
                  case "dang-nhap-thanh-toan":                                                
                        ?>@include("frontend.login-checkout")<?php
                        break;
                  case "hoan-tat-thanh-toan":                                                
                        ?>@include("frontend.finished-checkout")<?php
                        break;
                  case "hoa-don":                                                
                        ?>@include("frontend.invoice")<?php
                        break;                                                                        
            }

    ?>
  </div>
  <div class="col-md-3">
   
  </div>

@endsection()               