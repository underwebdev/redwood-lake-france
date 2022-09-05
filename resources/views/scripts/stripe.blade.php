<script>
    var stripe = Stripe('{{ $pk }}',
    {
            stripeAccount: "{{ $connect }}"
    });

    // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            iconColor: '#c4f0ff',
            color: '#262626',
            fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '18px',
            fontWeight: 'strong',
            textTransform: 'uppercase',
            '::placeholder': {
            color: '#aab7c4',
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {hidePostalCode: false, style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            const { paymentIntent, error } = await stripe.handleCardPayment(
                clientSecret, cardElement, {
                    payment_method_data: {
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.handleCardPayment(clientSecret, card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {

                    if (result.paymentIntent.status === 'succeeded') {
                        // Show a success message to your customer
                        // There's a risk of the customer closing the window before callback execution
                        // Set up a webhook or plugin to listen for the payment_intent.succeeded event
                        // to save the card to a Customer
                        window.location = '/payment-complete';
                      }
                }
            });
        });

        

        // Submit the form with the token ID.
        function stripePaymentHandler(paymentIntent) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripePaymentMethod');
        hiddenInput.setAttribute('value', paymentIntent.payment_method);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
        }
</script> 