<style>
    @font-face{
    src: url("./poppins.ttf");
    font-family: "poppins";
}
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    list-style: none;
    list-style: none;
    text-decoration: none;
    font-family: "Poppins";
}

body{
    background: #e3e9f7;

}
img{
    width: 100%;
}
header{
    width: 80%;
    height: 70px;
    background: #1787cc;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 40px;
    border-radius: 0 0 10px 10px;
    margin: 0 auto;
}
.logo{
    width:120px;
    margin-top: 8px;
}
nav .logo{
    display: none;
}
nav ul{
    display: flex;
}
nav ul li a{
    color: #212526;
    display: block;
    margin: 0 2px;
    font-weight: 600;
    padding: 8px 18px;
    transition: 0.2s;
    border-radius: 30px;
}

nav ul li a:hover{
    background: #f6f4ff;
}
nav ul li a:active{
    background: #675cff;
    color: #fff;
}
.hamburger{
    display: none;
    height: fit-content;
    cursor: pointer;
    padding: 3px 8px;
    border-radius: 5px;
    transition: 0.2s;
}

.hamburger:hover{
    background: #f6f4ff;
}
.hamburger div{
   width: 30px;
   height:2px;
   margin: 6px 0;
   background: #312526; 
}
@media only screen and (max-width:1100px){
    header{
        width:90%;
        padding: 0 20px;

    }nav{
        position: absolute;
        left: -300px;
        top: 0;
        z-index: 999;
        width: 280px;
        height: 100vh;
        background-color: #fefefe;
        transition: 0.2s;
        box-shadow: 2px 0 20px 0 rgb(0,0,0,0.05);
    }
    #nav_check:checked ~ nav{
        left:0;
    }

    nav.logo{
        display: block;
        height: 70px;
        display: flex;
        align-items: center;
        margin-left: 30px;

    }
    nav ul li a{
        margin-bottom: 5px;
        padding: 10px 15px;
        border-radius: 5px;

    }
    nav ul{
        display: block;
        padding: 0 20px;
        margin-top: 30px;

    }
    .hamburger{
        display: block;
    }
}
</style>

<header>
        <div class="logo">
            <img src="kdu-logo2.png" alt="">
        </div>
        <input type="checkbox" id="nav_check" hidden>
        <nav>
            <div class="logo">
                <img src="kdu-logo2.png" alt="kdu-logo2">
            </div>
            <ul>
                <li>
                    <a href="" class="active">Home</a>
                </li>
                <li>
                    <a href="">Products</a>
                </li>
                <li>
                    <a href="">Pricing</a>
                </li>
                <li>
                    <a href="">About</a>
                </li>
                <li>
                    <a href="">Conctact</a>
                </li>
            </ul>
        </nav>
         <label for="nav_check" class="hamburger">
            <div></div>
            <div></div>
            <div></div>
    </header>