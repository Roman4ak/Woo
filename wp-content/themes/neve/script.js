jQuery(document).ready(function($) {
    var zones = {
        'Залізничний': ['вул Чабіка', 'вул Чака', 'вул Мутного'],
        'Франківський': ['вул Бандери', 'вул Шухевича', 'вул Мельника'],
        'Галицький': ['вул Пса Патрона', 'вул Залужного', 'вул Зеленського'],
        'тестова зона': []
    };
    
    var options = $('#shipping_options').html();
    
    $('#shipping_zone').change(function(){
        var zone = $(this).val();
        var opts = '';
        
        if (zones.hasOwnProperty(zone)) {
            var streets = zones[zone];
            for (var i = 0; i < streets.length; i++) {
                opts += '<option value="' + streets[i] + '">' + streets[i] + '</option>';
            }
        } else {
            opts += '<option value="">Оберіть вулицю</option>';
        }
        
        $('#shipping_options').html(opts);
    });

    const shippingZoneSelect = document.getElementById("shipping_zone");
    const billingPostcodeInput = document.getElementById("billing_postcode");

    shippingZoneSelect.addEventListener("change", () => {
        const selectedZone = shippingZoneSelect.value;

        switch (selectedZone) {
            case "Залізничний":
                billingPostcodeInput.value = "79039";
                break;
            case "Франківський":
                billingPostcodeInput.value = "79000";
                break;
            case "Галицький":
                billingPostcodeInput.value = "79008";
                break;
            default:
                billingPostcodeInput.value = "";
                break;
        }

        const selfPickupRadio = document.querySelector('.woocommerce-shipping-methods > li:nth-of-type(2) > input[type="radio"]');
        const selfPickupLabel = document.querySelector('.woocommerce-shipping-methods > li:nth-of-type(2) > label');

        if (selfPickupRadio) {
        if (selfPickupRadio.hasAttribute('checked')) {
            const firstLiElement = document.querySelector('.woocommerce-shipping-methods > li:nth-of-type(1) > input[type="radio"]');
            firstLiElement.click();
        } else {
            selfPickupRadio.click();
        }
        } else if (selfPickupLabel) {
        selfPickupLabel.click();
        }
    });

    function handleShippingZoneChange() {
        // перевіряємо наявність класу zone-active
        const activeZone = document.querySelector('.zone-active');
        if (activeZone) {
          // якщо клас присутній, видаляємо його
          activeZone.classList.remove('zone-active');
        }
        
        // отримуємо вибрану зону доставки
        const selectedZone = document.getElementById('shipping_zone').value;
        
        // додаємо клас zone-active до відповідного класу в залежності від вибору
        if (selectedZone === 'Залізничний') {
          document.querySelector('.zal').classList.add('zone-active');
        } else if (selectedZone === 'Франківський') {
          document.querySelector('.fran').classList.add('zone-active');
        } else if (selectedZone === 'Галицький') {
          document.querySelector('.gal').classList.add('zone-active');
        }
      }
      
      // встановлюємо обробник події на зміну значення поля shipping_zone
      document.getElementById('shipping_zone').addEventListener('change', handleShippingZoneChange);
      
      document.addEventListener( 'DOMContentLoaded', function() {
        var input = document.getElementById( 'billing_postcode' );
        if ( input ) {
          input.setAttribute( 'value', '79008' );
        }
      });

});