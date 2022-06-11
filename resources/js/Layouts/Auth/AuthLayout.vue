<template>
    <div style="background-color: #666666;">
        <slot/>
    </div>
</template>

<script>
import './vendor/bootstrap/css/bootstrap.min.css'
import './fonts/font-awesome-4.7.0/css/font-awesome.min.css'
import './fonts/Linearicons-Free-v1.0.0/icon-font.min.css'
import './vendor/animate/animate.css'
import './vendor/css-hamburgers/hamburgers.min.css'
import './vendor/animsition/css/animsition.min.css'
import './vendor/select2/select2.min.css'
import './vendor/daterangepicker/daterangepicker.css'

import './vendor/jquery/jquery-3.2.1.min.js'
import './vendor/animsition/js/animsition.min.js'
import './vendor/bootstrap/js/popper.js'
// import './vendor/bootstrap/js/bootstrap.min.js'
// import './vendor/select2/select2.min.js'
// import './vendor/countdowntime/countdowntime.js'
import './js/main.js'

export default {
    name: "AuthLayout"
}
</script>

<style>
@import "./css/util.css";
@import "./css/main.css";

@font-face {
    font-family: Poppins-Regular;
    src: url('./fonts/poppins/Poppins-Regular.ttf');
}

@font-face {
    font-family: Poppins-Medium;
    src: url('./fonts/poppins/Poppins-Medium.ttf');
}

@font-face {
    font-family: Poppins-Bold;
    src: url('./fonts/poppins/Poppins-Bold.ttf');
}

@font-face {
    font-family: Poppins-SemiBold;
    src: url('./fonts/poppins/Poppins-SemiBold.ttf');
}

@font-face {
    font-family: Montserrat-Bold;
    src: url('./fonts/montserrat/Montserrat-Bold.ttf');
}

@font-face {
    font-family: Montserrat-SemiBold;
    src: url('./fonts/montserrat/Montserrat-SemiBold.ttf');
}

@font-face {
    font-family: Montserrat-Regular;
    src: url('./fonts/montserrat/Montserrat-Regular.ttf');
}

.bg-login {
    background-image: url('./images/bg-04.jpg');
}

</style>
