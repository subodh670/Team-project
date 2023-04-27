<!DOCTYPE html>
<html>
<style>
#myProgress {
  width: 80%;
  margin: 0 auto;
  background-color: white;
  display: flex;
  justify-content: start;
  align-items: center;
  height: 100vh;
}

#myBar {
  width: 10%;
  height: 30px;
  background-color: #04AA6D;
  text-align: center;
  line-height: 30px;
  color: white;
}
</style>
<body>


<div id="myProgress">
  <div id="myBar">10%</div>
</div>

<br>
<!-- <button onclick="move()">Click Me</button>  -->

<script>
var i = 0;
function move() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 10;
    var id = setInterval(frame, 10);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        i = 0;
        window.location.href = "http://localhost/Team%20project-oracle/Team-project/sign_in_page/index.php";
      } else {
        width++;
        elem.style.width = width + "%";
        elem.innerHTML = width  + "%";
      }
    }
  }
}
move();
</script>

</body>
</html>