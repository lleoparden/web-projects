<!DOCTYPE html>
<html lang="en">
<head>
    <title>log in</title>

    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<style>
      body {
    padding-top: 15px;
    font-size: 12px
  }
  .wrapper {
  --input-focus: #2d8cf0;
  --font-color: #323232;
  --font-color-sub: #666;
  --bg-color: #fff;
  --bg-color-alt: #666;
  --main-color: #323232;
    display: flex;
    flex-direction: column; 
    align-items: center; 
    margin-top: 25%;
}
/* switch card */
.switch {
  transform: translateY(-200px);
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 30px;
  width: 50px;
  height: 20px;
}

.card-side::before {
  position: absolute;
  content: 'Log in';
  left: -70px;
  top: 0;
  width: 100px;
  text-decoration: underline;
  color: var(--font-color);
  font-weight: 600;
}

.card-side::after {
  position: absolute;
  content: 'Sign up';
  left: 70px;
  top: 0;
  width: 100px;
  text-decoration: none;
  color: var(--font-color);
  font-weight: 600;
}

.toggle {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  box-sizing: border-box;
  border-radius: 5px;
  border: 2px solid var(--main-color);
  box-shadow: 4px 4px var(--main-color);
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: var(--bg-colorcolor);
  transition: 0.3s;
}

.slider:before {
  box-sizing: border-box;
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  border: 2px solid var(--main-color);
  border-radius: 5px;
  left: -2px;
  bottom: 2px;
  background-color: var(--bg-color);
  box-shadow: 0 3px 0 var(--main-color);
  transition: 0.3s;
}

.toggle:checked + .slider {
  background-color: var(--input-focus);
}

.toggle:checked + .slider:before {
  transform: translateX(30px);
}

.toggle:checked ~ .card-side:before {
  text-decoration: none;
}

.toggle:checked ~ .card-side:after {
  text-decoration: underline;
}

/* card */ 

.flip-card__inner {
  width: 300px;
  height: 350px;
  position: relative;
  background-color: transparent;
  perspective: 1000px;
    /* width: 100%;
    height: 100%; */
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

.toggle:checked ~ .flip-card__inner {
  transform: rotateY(180deg);
}

.toggle:checked ~ .flip-card__front {
  box-shadow: none;
}

.flip-card__front, .flip-card__back {
  padding: 20px;
  position: absolute;
  display: flex;
  flex-direction: column;
  justify-content: center;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  background: lightgrey;
  gap: 20px;
  border-radius: 5px;
  border: 2px solid var(--main-color);
  box-shadow: 4px 4px var(--main-color);
}

.flip-card__back {
  width: 100%;
  transform: rotateY(180deg);
}

.flip-card__form {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}

.title {
  margin: 20px 0 20px 0;
  font-size: 25px;
  font-weight: 900;
  text-align: center;
  color: var(--main-color);
}

.flip-card__input {
  width: 250px;
  height: 40px;
  border-radius: 5px;
  border: 2px solid var(--main-color);
  background-color: var(--bg-color);
  box-shadow: 4px 4px var(--main-color);
  font-size: 15px;
  font-weight: 600;
  color: var(--font-color);
  padding: 5px 10px;
  outline: none;
}

.flip-card__input::placeholder {
  color: var(--font-color-sub);
  opacity: 0.8;
}

.flip-card__input:focus {
  border: 2px solid var(--input-focus);
}

.flip-card__btn:active, .button-confirm:active {
  box-shadow: 0px 0px var(--main-color);
  transform: translate(3px, 3px);
}

.flip-card__btn {
  margin: 20px 0 20px 0;
  width: 120px;
  height: 40px;
  border-radius: 5px;
  border: 2px solid var(--main-color);
  background-color: var(--bg-color);
  box-shadow: 4px 4px var(--main-color);
  font-size: 17px;
  font-weight: 600;
  color: var(--font-color);
  cursor: pointer;
} 
</style>


<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
      $action = $_POST['action'];
    }
  switch($action)
    {
      case ('register'):{
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

      $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $username, $email, $password);
      if ($stmt->execute()) {
          echo "Registration successful!";
      }else {
        echo "Error: " . $stmt->error;
      }
      $stmt->close();
      break;
      }


      case ('login'):{
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            
            $_SESSION['user_id'] = $id;
            echo "Login successful! ". $username;
        } else {
            echo "Invalid username or password.";
        }
        $stmt->close();
        break;
      }
    }
}
?>

</head>
<body>
  
    <button type="button" class="close" onclick="window.location.href = 'home.html';" style="margin-right: 20px;">X</button>
    <div class="wrapper">
      <div class="card-switch">
          <label class="switch">
             <input class="toggle" type="checkbox">
             <span class="slider"></span>
             <span class="card-side"></span>
             <div class="flip-card__inner">
                <div class="flip-card__front">
                   <div class="title">Log in</div>
                   <form method="post" action="loginpage.php" class="flip-card__form">
                      <input type="name" placeholder="uesrname" name="username" class="flip-card__input"required>
                      <input type="password" placeholder="Password" name="password" class="flip-card__input"required>
                      <button class="flip-card__btn" name="action" value =login>Let`s go!</button>
                   </form>
                </div>
                <div class="flip-card__back">
                   <div class="title">Sign up</div>
                   <form method="post" action="loginpage.php" class="flip-card__form">
                      <input type="name" placeholder="Name"  name="username" class="flip-card__input" required>
                      <input type="email" placeholder="Email" name="email" class="flip-card__input"required>
                      <input type="password" placeholder="Password" name="password" class="flip-card__input"required>
                      <button class="flip-card__btn" name="action" value =register>Confirm!</button>
                   </form>
                </div>
             </div>
          </label>
      </div>   
 </div>
</body>
</html>