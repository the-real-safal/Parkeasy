<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Footer with Social Media Links</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
	    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');

body {
  margin: 0;
  padding: 0;
  font-family: 'Poppins', sans-serif;
}

footer {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
}
a  {
			color: #0A81D1;
			text-decoration: none;
		}

		a :hover {
			color: #ffb703;
            
		}

.social-links {
  display: flex;
  justify-content: center;
  gap: 15px;
  margin-bottom: 10px;
}

.social-link {
  display: inline-block;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  overflow: hidden;
  transition: transform 0.3s;
}

.social-link img {
  width: 100%;
  height: 100%;
}

.social-link:hover {
  transform: scale(1.2);
}

p {
  margin: 0;
}

</style>
</head>
<body>
  <footer>
    <div class="social-links">
	  <a class="social-link" href="#"><i class="fab fa-facebook"></i></a>
					<a class="social-link" href="#"><i class="fab fa-twitter"></i></a>
					<a class="social-link" href="#"><i class="fab fa-instagram"></i></a>
					<a class="social-link" href="#"><i class="fab fa-linkedin"></i></a>
    </div>
    <p>&copy; 2023 <a class="name">ParkEasy</a>. All rights reserved.</p>
  </footer>
</body>
</html>
