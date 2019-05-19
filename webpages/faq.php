<?php
include_once 'header.php';
?>

<div id="body">

<div class="faqpanel">

<div class="faqs">

<h1>Frequently Asked Questions</h1>

<button class="accordion"><span class="fontz">How long will it take for my food to arrive?</span></button>
<div class="panel">
  <p>Depending on the time your order was made, as well as depending on the distance of the restaurant to your home address, orders processed may take between 30-50 minutes time.</p>
</div>

<button class="accordion"><span class="fontz">What is your refund policy?</span></button>
<div class="panel">
  <p>EasyKey Solutions such matters very seriously and will look into individual cases thoroughly on a case-by-base basis.</br></br>
      Any products that falls under the below categories should not be thrown away before taking photo proof
      and emailing the photo of the affected product and your Delivery Order to us at cs@easykeysolutions.com (if applicable).</br></br>
      We regret to inform you that no refunds will be given for orders that fall under the below categories.</br></br>
      1. In the event that the product you've received is unsatisfactory in any way you perceive,
      we will require photo proof of the product and your D.O (Delivery Order) as well and you may be required
      to send us back the product for close inspection and review before a decision is made to re-send a product to you at no cost, subject to availability.
      The postage cost will be credited back to your account after we receive the returned item.</br></br>
      2. In the event that you receive a product that damaged, we will require clear photo proof of the product and its expiry date for close inspection and review
      before a decision is made to re-send a product to you at no cost, subject to availability.</br></br>
      3. In the event that you've received the wrong product, we will require photo proof of the wrongly sent product and D.O (Delivery Order) and after reviewing
      , we'll re-send the correct product to you at no cost, subject to availability.</br></br>
      4. In the event you've received your order with a missing product, we will require you to email us a clear photo proof of your D.O (Delivery Order)
      to cs@easykeysolutions.com and after which, kindly give us a call at (+60) 0928519223 and our customer service representative will attend to you to find out more before
      a decision is made to re-send the missing product to you at no cost, subject to availability.</p>
</div>

<button class="accordion"><span class="fontz">What if I am unavailable on the delivery date?</span></button>
<div class="panel">
  <p>You can e-mail us at cs@easykeysolutions.com and we shall arrange a second delivery to your address.
    In the event that the second delivery fails, we shall impose a service charge for any subsequent requests for a re-delivery.
    EasyKey Solutions reserves all rights to cancel a delivery that is underway to a customer should an emergency arise.</p>
</div>

</div>

</div>

</div>

<script type="text/javascript">
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
</script>

<?php
include_once 'footer.php';
?>
