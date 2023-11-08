import "./bootstrap.js";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import "preline";
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./app/styles/app.css";

window.addEventListener("DOMContentLoaded", () => {
  console.log(ClassicEditor);
  ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
    console.error(error);
  });
});
