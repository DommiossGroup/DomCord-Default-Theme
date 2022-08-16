<?php

header("content-type: text/css; charset: UTF-8");
ob_start('ob_gzhandler');
header('Cache-Control: max-age=31536000, must-revalidate');

$theme = htmlspecialchars($_GET['theme_name_domcord_root']);

?>
/*

DOMCORD

All rights reserved to DommiossGroup. You are not allowed to sell this code, so please don't :)

*/

body {
font-family: "Nunito", sans-serif;
}


/*# Bannière du site + Navbar*/

.gradient-banner {
position: relative;
overflow: hidden;
}

.gradient-banner::before {
position: absolute;
content: '';
bottom: 0;
left: 50%;
-webkit-transform: translateX(-50%);
transform: translateX(-50%);
width: 200%;
height: 200%;
background: linear-gradient(to bottom, rgba(35, 76, 222, 0.80), rgba(35, 76, 222, 0.60)), url('../img/background.png') no-repeat;
background-size: cover
}

section {
height: 50vh;
overflow: hidden;
position: relative;
color: #fff;
}

section:before {
background-size: cover;
content: "";
position: absolute;
z-index: -1;
}

.layer {
position: absolute;
left: 0;
right: 0;
top: 0;
bottom: 0;
background-color: rgba(0, 0, 0, 0.36);
}

.animate-pop-in {
animation: pop-in .6s cubic-bezier(0, 0.9, 0.3, 1.2) forwards;
opacity: 0;
}

@keyframes pop-in {
0% {
opacity: 0;
transform: translate(-4rem) scale(.8);
}
100% {
opacity: 1;
transform: none;
}
}

.header-title {
animation-delay: 1s;
font-size: 200%;
line-height: normal;
margin: 10px auto 15px;
}
.sub-title {
animation-delay: 1s;
font-size: 150%;
line-height: normal;
margin: 10px auto 15px;
}

.center-absolute {
width: 100%;
position: absolute;
left: 50%;
z-index: 999;
top: 46%;
text-align: center;
transform: translate(-50%, -50%);
-webkit-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
}

.bg-header-buttons {
background: rgba(0, 0, 0, 0.2)
}


/*# Boutons */

.btn {
text-align: center;
vertical-align: middle;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
padding: 0.625rem 1.5rem;
line-height: 1.5;
border-radius: 100px;
transition-duration: 0.4s;
}

.btn-primary {
background-color: #5956E9;
border-color: #5956E9;
color: #ffffff;
}
.btn-outline-primary {
border-color: #5956E9;
color: #5956E9;
}

.btn-primary:hover {
background-color: #4b49da;
border-color: #4b49da;
color: #ffffff;
}

.btn-outline-primary:hover {
background-color: #4b49da;
border-color: #4b49da;
color: #ffffff;
}

.link {
text-decoration: none;
color: #5956E9;
}

.link:hover {
text-decoration: none;
color: #615feb;
}

.alert-primary {
background-color: #5956E9;
border-color: #5956E9;
color: #ffffff;
}

.alert-danger {
background-color: #DC143C;
border-color: #DC143C;
color: #ffffff;
}

.alert-warning {
background-color: #FFD700;
border-color: #FFD700;
color: #000000;
}

.alert-success {
background-color: #2E8B57;
border-color: #2E8B57;
color: #ffffff;
}

div.big-separator {
height: 100px;
}

div.medium-separator {
height: 50px;
}

div.separator {
height: 10px;
}

div.small-separator {
height: 8px;
}


/* - */

.mt-100 {
margin-top: 100px
}

.card {
box-shadow: 0 0.46875rem 2.1875rem rgba(4, 9, 20, 0.03), 0 0.9375rem 1.40625rem rgba(4, 9, 20, 0.03), 0 0.25rem 0.53125rem rgba(4, 9, 20, 0.05), 0 0.125rem 0.1875rem rgba(4, 9, 20, 0.03);
border-width: 0;
transition: all .2s
}

.card-header:first-child {
border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
}

.card-header {
display: flex;
align-items: center;
border-bottom-width: 1px;
padding-top: 0;
padding-bottom: 0;
padding-right: .625rem;
height: 3.5rem;
background-color: #fff;
border-bottom: 1px solid rgba(26, 54, 126, 0.125)
}

.card-body {
flex: 1 1 auto;
padding: 1.25rem
}

.flex-truncate {
min-width: 0 !important
}

.d-block {
display: block !important
}

a {
color: #5956E9;
text-decoration: none !important;
background-color: transparent
}

.media img {
width: 40px;
height: auto
}

.bg-purple {
background-color: #5956E9;
border-color: #5956E9;
color: #ffffff;
}

.text-purple {
color: #5956E9
}


.single_advisor_profile {
position: relative;
margin-bottom: 50px;
-webkit-transition-duration: 500ms;
transition-duration: 500ms;
z-index: 1;
border-radius: 15px;
-webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
}

.single_advisor_profile .advisor_thumb {
position: relative;
z-index: 1;
border-radius: 15px 15px 0 0;
margin: 0 auto;
padding: 30px 30px 0 30px;
background-color: #3f43fd;
overflow: hidden;
}

.single_advisor_profile .advisor_thumb::after {
-webkit-transition-duration: 500ms;
transition-duration: 500ms;
position: absolute;
width: 150%;
height: 80px;
bottom: -45px;
left: -25%;
content: "";
background-color: #ffffff;
-webkit-transform: rotate(-15deg);
transform: rotate(-15deg);
}

@media only screen and (max-width: 575px) {
.single_advisor_profile .advisor_thumb::after {
height: 160px;
bottom: -90px;
}
}

.single_advisor_profile .advisor_thumb .social-info {
position: absolute;
z-index: 1;
width: 100%;
bottom: 0;
right: 30px;
text-align: right;
}

.single_advisor_profile .advisor_thumb .social-info a {
font-size: 14px;
color: #020710;
padding: 0 5px;
}

.single_advisor_profile .advisor_thumb .social-info a:hover,
.single_advisor_profile .advisor_thumb .social-info a:focus {
color: #3f43fd;
}

.single_advisor_profile .advisor_thumb .social-info a:last-child {
padding-right: 0;
}

.single_advisor_profile .single_advisor_details_info {
position: relative;
z-index: 1;
padding: 30px;
text-align: right;
-webkit-transition-duration: 500ms;
transition-duration: 500ms;
border-radius: 0 0 15px 15px;
background-color: #ffffff;
}

.single_advisor_profile .single_advisor_details_info::after {
-webkit-transition-duration: 500ms;
transition-duration: 500ms;
position: absolute;
z-index: 1;
width: 50px;
height: 3px;
background-color: #3f43fd;
content: "";
top: 12px;
right: 30px;
}

.single_advisor_profile .single_advisor_details_info h6 {
margin-bottom: 0.25rem;
-webkit-transition-duration: 500ms;
transition-duration: 500ms;
}

@media only screen and (min-width: 768px) and (max-width: 991px) {
.single_advisor_profile .single_advisor_details_info h6 {
font-size: 14px;
}
}

.single_advisor_profile .single_advisor_details_info p {
-webkit-transition-duration: 500ms;
transition-duration: 500ms;
margin-bottom: 0;
font-size: 14px;
}

@media only screen and (min-width: 768px) and (max-width: 991px) {
.single_advisor_profile .single_advisor_details_info p {
font-size: 12px;
}
}

.single_advisor_profile:hover .advisor_thumb::after,
.single_advisor_profile:focus .advisor_thumb::after {
background-color: #070a57;
}

.single_advisor_profile:hover .advisor_thumb .social-info a,
.single_advisor_profile:focus .advisor_thumb .social-info a {
color: #ffffff;
}

.single_advisor_profile:hover .advisor_thumb .social-info a:hover,
.single_advisor_profile:hover .advisor_thumb .social-info a:focus,
.single_advisor_profile:focus .advisor_thumb .social-info a:hover,
.single_advisor_profile:focus .advisor_thumb .social-info a:focus {
color: #ffffff;
}

.single_advisor_profile:hover .single_advisor_details_info,
.single_advisor_profile:focus .single_advisor_details_info {
background-color: #070a57;
}

.single_advisor_profile:hover .single_advisor_details_info::after,
.single_advisor_profile:focus .single_advisor_details_info::after {
background-color: #ffffff;
}

.single_advisor_profile:hover .single_advisor_details_info h6,
.single_advisor_profile:focus .single_advisor_details_info h6 {
color: #ffffff;
}

.single_advisor_profile:hover .single_advisor_details_info p,
.single_advisor_profile:focus .single_advisor_details_info p {
color: #ffffff;
}

.flex-truncate {
min-width: 0 !important
}

.d-block {
display: block !important
}

.mt-100 {
margin-top: 100px
}

.media img {
width: 40px;
height: auto
}