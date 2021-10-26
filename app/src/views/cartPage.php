<?php

use Doctrine\DBAL\Driver\Mysqli\Exception\InvalidOption;

include 'header.php';
require PROJECT_ROOT_PATH.'/vendor/autoload.php';

$cart = $cartController->getCartByProfileId($profile['id']);
if(!$cart){
  echo "<h1>You dont have any items in your cart.</h1>
  <a href='?action=products'>Browse products?</a>
  ";
}
?>
<div class="container">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col-grow-1">Description</th>
      <th scope="col">QTY</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
<?php
  $i = 0;
  $total = 0;
foreach($cart as $c){
  $i++;
  $total += $c['price']*$c['quantity'];
  echo "
  <tr>
    <th scope='row'>$i</th>
    <td>$c[title]</td>
    <td>$c[description]</td>
    <td>$c[quantity]</td>
    <td>".$c['price']*$c['quantity']."</td>
  </tr>
";
}
echo "
  <tr>
    <th scope='row'></th>
    <td></td>
    <td></td>
    <td>Total</td>
    <td>$total</td>
  </tr>
</tbody>
</table>

<div id='paypal-button-container' class='d-flex justify-content-center'></div>

<script>
paypal.Buttons({
  createOrder: function(data, actions) {
    return actions.order.create({
      'purchase_units': [{
         'amount': {
           'currency_code': 'USD',
           'value': '100',
           'breakdown': {
             'item_total': {  /* Required when including the `items` array */
               'currency_code': 'USD',
               'value': '100'
             }
           }
         },
         'items': [
           {
             'name': 'test', /* Shows within upper-right dropdown during payment approval */
             'description': 'test', /* Item details will also be in the completed paypal.com transaction view */
             'unit_amount': {
               'currency_code': 'USD',
               'value': '100'
             },
             'quantity': '1'
           },
         ]
       }]
   });
 },
  onApprove: function(data, actions) {
    // This function captures the funds from the transaction.
    return actions.order.capture().then(function(details) {
      // This function shows a transaction success message to your buyer.
      console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
      var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction '+ transaction.status + ': ' + transaction.id);
    })
  }
}).render('#paypal-button-container');

// When ready to go live, remove the alert and show a success message within this page. For example:
// var element = document.getElementById('paypal-button-container');
// element.innerHTML = '';
// element.innerHTML = '<h3>Thank you for your payment!</h3>';
// Or go to another URL:  actions.redirect('thank_you.html');
</script>";

?>
</div>
<?php
include "footer.php";