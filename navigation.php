<style>
@import url('htpps.googleapis.com/css?family=Montserrat:500');

*{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    background-color: #24252A;

}

li,a,button{
    font-family: "Montserrat",sans-serif;
    font-weight: 500;
    color: #edf0f1;
    text-decoration: none;
}

header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px 10%;
}

.logo{
    cursor: pointer;
}

.nav_links{
    list-style: none;
}

.nav_links li{
    display: inline-block;
    padding: 0px 20px;
}

.nav_links li a {
    transition: all 0.3s ease 0s;
}

.nav_links li a:hover{
    color: #0088a9;
}

button{
    padding: 9px 25px;
    background-color: rgba(0,136,169,1);
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease 0s;
}

button:hover{
    background-color: rgb(0,136,169,0.8);

}
</style>

<header>
        <img class="logo" src="kdu-logo2.png" alt="logo">
        <nav>
            <ul class="nav_links">   
                <li><a href="#">Home</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact Us</a></li>
             
            </ul>
        </nav>
        <a class="cta" href="logout.php"><button>Log out</a>
    </header>