// Get the order form
var orderForm = document.getElementById("order-form");

// Add an event listener for form submission
orderForm.addEventListener("submit", function(event) {
  event.preventDefault();
  
  // Get the form data
  var formData = new FormData(orderForm);
  
  // Send the form data to the server
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "place-order.php");
  xhr.onload = function() {
    if (xhr.status === 200) {
      alert("Order placed successfully");
    } else {
      alert("Error placing order");
    }
  };
  xhr.send(formData);
});/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


