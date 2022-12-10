<form action="{{route('make-payment')}}" method="POST">
    @csrf
  <script
    src="https://checkout.stripe.com/checkout.js"
    class="stripe-button"
    data-key="pk_test_51MBgcsSC4b1LIgo42cPNZft0JhGUJ3E4NyPXhEwR2azEll5KVdVMxvs63drbKieUJeH1kdgycUOLgH0Zzf2TLS5c00jzINDTnz"
    data-name="T-shirt"
    data-description="Comfortable cotton t-shirt"
    data-amount="500"
    data-image="image path"
    data-currency="inr"
    data-label="Pyment">
  </script>
  <!-- data-key me Publishable key hai -->
</form>
