<?php
session_start();
include "../inc/connect.php";

$email = $_SESSION["email"];

// Fetch data from the transaction table
$query = "SELECT transaction.*, users.name, users.email AS user_email, areas.name AS area_name 
          FROM transaction 
          INNER JOIN users ON transaction.user_id = users.id 
          INNER JOIN areas ON transaction.area_id = areas.id";
$result = $conn->query($query);

$data = []; // Array to hold fetched data

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Add each row to the data array
    }
}
?>

<?php
include('inc/connect.php');
?>
<header class="nav-head" style="position:sticky; top:0px; z-index: 2;">
    <?php include('inc/header.php'); ?>
  </header>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>All Transactions</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <style>
:root {
  --dark-color: hsl(var(--hue), 100%, 9%);
  --light-color: hsl(var(--hue), 95%, 98%);
  --base: hsl(var(--hue), 95%, 50%);
  --complimentary1: hsl(var(--hue-complimentary1), 95%, 50%);
  --complimentary2: hsl(var(--hue-complimentary2), 95%, 50%);

  --font-family: "Poppins", system-ui;

  --bg-gradient: linear-gradient(
    to bottom,
    hsl(var(--hue), 95%, 99%),
    hsl(var(--hue), 95%, 84%)
  );
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

body {
  max-width: 1920px;
  min-height: 100vh;
  display: grid;
  place-items: center;
  padding: 0rem;
  font-family: var(--font-family);
  color: var(--dark-color);
  background: var(--bg-gradient);
}

.orb-canvas {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: -1;
}

strong {
  font-weight: 600;
}

.overlay {
  width: 100%;
  max-width: 1140px;
  max-height: 640px;
  padding: 8rem 6rem;
  display: flex;
  align-items: center;
  background: rgba(255, 255, 255, 0.375);
  box-shadow: 0 0.75rem 2rem 0 rgba(0, 0, 0, 0.1);
  border-radius: 2rem;
  border: 1px solid rgba(255, 255, 255, 0.125);
}

.overlay__inner {
  max-width: 36rem;
}

.overlay__title {
  font-size: 1.875rem;
  line-height: 2.75rem;
  font-weight: 700;
  letter-spacing: -0.025em;
  margin-bottom: 2rem;
}

.text-gradient {
  background-image: linear-gradient(
    45deg,
    var(--base) 25%,
    var(--complimentary2)
  );
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  -moz-background-clip: text;
  -moz-text-fill-color: transparent;
}

.overlay__description {
  font-size: 1rem;
  line-height: 1.75rem;
  margin-bottom: 3rem;
}

.overlay__btns {
  width: 100%;
  max-width: 30rem;
  display: flex;
}

.overlay__btn {
  width: 50%;
  height: 2.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--light-color);
  background: var(--dark-color);
  border: none;
  border-radius: 0.5rem;
  transition: transform 150ms ease;
  outline-color: hsl(var(--hue), 95%, 50%);
}

.overlay__btn:hover {
  transform: scale(1.05);
  cursor: pointer;
}

.overlay__btn--transparent {
  background: transparent;
  color: var(--dark-color);
  border: 2px solid var(--dark-color);
  border-width: 2px;
  margin-right: 0.75rem;
}

.overlay__btn-emoji {
  margin-left: 0.375rem;
}

a {
  text-decoration: none;
  color: var(--dark-color);
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Not too many browser support this yet but it's good to add! */
@media (prefers-contrast: high) {
  .orb-canvas {
    display: none;
  }
}

@media only screen and (max-width: 1140px) {
  .overlay {
    padding: 8rem 4rem;
  }
}

@media only screen and (max-width: 840px) {
  body {
    padding: 1.5rem;
  }

  .overlay {
    padding: 4rem;
    height: auto;
  }

  .overlay__title {
    font-size: 1.25rem;
    line-height: 2rem;
    margin-bottom: 1.5rem;
  }

  .overlay__description {
    font-size: 0.875rem;
    line-height: 1.5rem;
    margin-bottom: 2.5rem;
  }
}

@media only screen and (max-width: 600px) {
  .overlay {
    padding: 1.5rem;
  }

  .overlay__btns {
    flex-wrap: wrap;
  }

  .overlay__btn {
    width: 100%;
    font-size: 0.75rem;
    margin-right: 0;
  }

  .overlay__btn:first-child {
    margin-bottom: 1rem;
  }
}

    </style>
</head>
<body>
    <!-- Canvas -->
<canvas class="orb-canvas"></canvas>
<!-- Overlay -->
<div class="overlay">
<div class="container mt-5">
    <h2>All Transactions</h2>

    <!-- Add the "Daily Transaction" button here -->
    <a href="transaction.php" class="btn btn-primary mb-3">Daily Transaction</a>
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
        <tr>
        <th>ID</th>
            <th>Date</th>
            <th>Name</th>
            <th>Email</th>
            <th>Area</th>
            <th>Lot No.</th>
            <th>Duration</th>
            <th>Charge</th>
            <th>Status</th>
            <th>Transaction ID</th>
            <th>Refrence ID</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row) : ?>
            <tr>
            <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['user_email']; ?></td>
                <td><?php echo $row['area_name']; ?></td>
                <td><?php echo $row['lot_no']; ?></td>
                <td><?php echo $row['duration']; ?></td>
                <td><?php echo $row['charge']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['pay_id']; ?></td>
                <td><?php echo $row['ref_id']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mt-3">
        <!-- Export buttons (CSV and PDF) -->
        <button class="btn btn-success float-right" id="exportCsvBtn">Export to CSV</button>
        <button class="btn btn-success float-right mr-2" id="exportPdfBtn">Export to PDF</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script>
    $(document).ready(function () {
        const transactionTable = $('table').DataTable({
            dom: 'Bfrtip', // Add the export buttons to the DOM
            buttons: [
                'csv', // CSV export button
                {
                    extend: 'pdfHtml5', // PDF export button
                    customize: function (doc) {
                        doc.defaultStyle.fontSize = 10;
                    }
                },
                'print' // Print button
            ]
        });

        // Export to CSV button
        $('#exportCsvBtn').on('click', function () {
            transactionTable.button('.buttons-csv').trigger();
        });

        // Export to PDF button
        $('#exportPdfBtn').on('click', function () {
            transactionTable.button('.buttons-pdf').trigger();
        });
    });
</script>
<script type="module">
import * as PIXI from "https://cdn.skypack.dev/pixi.js@5.x";
import { KawaseBlurFilter } from "https://cdn.skypack.dev/@pixi/filter-kawase-blur@3.2.0";
import SimplexNoise from "https://cdn.skypack.dev/simplex-noise@3.0.0";
import hsl from "https://cdn.skypack.dev/hsl-to-hex";
import debounce from "https://cdn.skypack.dev/debounce";

// return a random number within a range
function random(min, max) {
  return Math.random() * (max - min) + min;
}

// map a number from 1 range to another
function map(n, start1, end1, start2, end2) {
  return ((n - start1) / (end1 - start1)) * (end2 - start2) + start2;
}

// Create a new simplex noise instance
const simplex = new SimplexNoise();

// ColorPalette class
class ColorPalette {
  constructor() {
    this.setColors();
    this.setCustomProperties();
  }

  setColors() {
    // pick a random hue somewhere between 220 and 360
    this.hue = ~~random(220, 360);
    this.complimentaryHue1 = this.hue + 30;
    this.complimentaryHue2 = this.hue + 60;
    // define a fixed saturation and lightness
    this.saturation = 95;
    this.lightness = 50;

    // define a base color
    this.baseColor = hsl(this.hue, this.saturation, this.lightness);
    // define a complimentary color, 30 degress away from the base
    this.complimentaryColor1 = hsl(
      this.complimentaryHue1,
      this.saturation,
      this.lightness
    );
    // define a second complimentary color, 60 degrees away from the base
    this.complimentaryColor2 = hsl(
      this.complimentaryHue2,
      this.saturation,
      this.lightness
    );

    // store the color choices in an array so that a random one can be picked later
    this.colorChoices = [
      this.baseColor,
      this.complimentaryColor1,
      this.complimentaryColor2
    ];
  }

  randomColor() {
    // pick a random color
    return this.colorChoices[~~random(0, this.colorChoices.length)].replace(
      "#",
      "0x"
    );
  }

  setCustomProperties() {
    // set CSS custom properties so that the colors defined here can be used throughout the UI
    document.documentElement.style.setProperty("--hue", this.hue);
    document.documentElement.style.setProperty(
      "--hue-complimentary1",
      this.complimentaryHue1
    );
    document.documentElement.style.setProperty(
      "--hue-complimentary2",
      this.complimentaryHue2
    );
  }
}

// Orb class
class Orb {
  // Pixi takes hex colors as hexidecimal literals (0x rather than a string with '#')
  constructor(fill = 0x000000) {
    // bounds = the area an orb is "allowed" to move within
    this.bounds = this.setBounds();
    // initialise the orb's { x, y } values to a random point within it's bounds
    this.x = random(this.bounds["x"].min, this.bounds["x"].max);
    this.y = random(this.bounds["y"].min, this.bounds["y"].max);

    // how large the orb is vs it's original radius (this will modulate over time)
    this.scale = 1;

    // what color is the orb?
    this.fill = fill;

    // the original radius of the orb, set relative to window height
    this.radius = random(window.innerHeight / 6, window.innerHeight / 3);

    // starting points in "time" for the noise/self similar random values
    this.xOff = random(0, 1000);
    this.yOff = random(0, 1000);
    // how quickly the noise/self similar random values step through time
    this.inc = 0.002;

    // PIXI.Graphics is used to draw 2d primitives (in this case a circle) to the canvas
    this.graphics = new PIXI.Graphics();
    this.graphics.alpha = 0.825;

    // 250ms after the last window resize event, recalculate orb positions.
    window.addEventListener(
      "resize",
      debounce(() => {
        this.bounds = this.setBounds();
      }, 250)
    );
  }

  setBounds() {
    // how far from the { x, y } origin can each orb move
    const maxDist =
      window.innerWidth < 1000 ? window.innerWidth / 3 : window.innerWidth / 5;
    // the { x, y } origin for each orb (the bottom right of the screen)
    const originX = window.innerWidth / 1.25;
    const originY =
      window.innerWidth < 1000
        ? window.innerHeight
        : window.innerHeight / 1.375;

    // allow each orb to move x distance away from it's x / y origin
    return {
      x: {
        min: originX - maxDist,
        max: originX + maxDist
      },
      y: {
        min: originY - maxDist,
        max: originY + maxDist
      }
    };
  }

  update() {
    // self similar "psuedo-random" or noise values at a given point in "time"
    const xNoise = simplex.noise2D(this.xOff, this.xOff);
    const yNoise = simplex.noise2D(this.yOff, this.yOff);
    const scaleNoise = simplex.noise2D(this.xOff, this.yOff);

    // map the xNoise/yNoise values (between -1 and 1) to a point within the orb's bounds
    this.x = map(xNoise, -1, 1, this.bounds["x"].min, this.bounds["x"].max);
    this.y = map(yNoise, -1, 1, this.bounds["y"].min, this.bounds["y"].max);
    // map scaleNoise (between -1 and 1) to a scale value somewhere between half of the orb's original size, and 100% of it's original size
    this.scale = map(scaleNoise, -1, 1, 0.5, 1);

    // step through "time"
    this.xOff += this.inc;
    this.yOff += this.inc;
  }

  render() {
    // update the PIXI.Graphics position and scale values
    this.graphics.x = this.x;
    this.graphics.y = this.y;
    this.graphics.scale.set(this.scale);

    // clear anything currently drawn to graphics
    this.graphics.clear();

    // tell graphics to fill any shapes drawn after this with the orb's fill color
    this.graphics.beginFill(this.fill);
    // draw a circle at { 0, 0 } with it's size set by this.radius
    this.graphics.drawCircle(0, 0, this.radius);
    // let graphics know we won't be filling in any more shapes
    this.graphics.endFill();
  }
}

// Create PixiJS app
const app = new PIXI.Application({
  // render to <canvas class="orb-canvas"></canvas>
  view: document.querySelector(".orb-canvas"),
  // auto adjust size to fit the current window
  resizeTo: window,
  // transparent background, we will be creating a gradient background later using CSS
  transparent: true
});

app.stage.filters = [new KawaseBlurFilter(30, 10, true)];

// Create colour palette
const colorPalette = new ColorPalette();

// Create orbs
const orbs = [];

for (let i = 0; i < 10; i++) {
  const orb = new Orb(colorPalette.randomColor());

  app.stage.addChild(orb.graphics);

  orbs.push(orb);
}

// Animate!
if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
  app.ticker.add(() => {
    orbs.forEach((orb) => {
      orb.update();
      orb.render();
    });
  });
} else {
  orbs.forEach((orb) => {
    orb.update();
    orb.render();
  });
}

document
  .querySelector(".overlay__btn--colors")
  .addEventListener("click", () => {
    colorPalette.setColors();
    colorPalette.setCustomProperties();

    orbs.forEach((orb) => {
      orb.fill = colorPalette.randomColor();
    });
  });
</script>
</body>
</html>