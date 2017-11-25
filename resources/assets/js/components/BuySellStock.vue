<template>
  <div>
    <h3>Buy/Sell Stocks</h3>
    <form class="form-horizontal" method="POST" action="/stocks-portfolio">
      <input type="hidden" name="_token" :value="token">
      <div v-show="loading" class="alert alert-info" role="alert">Loading stock infomation...</div>
      <div v-show="error" class="alert alert-danger" role="alert">No Stock found.</div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Ticket (i.e FB, GOOG)</label>
        <div class="col-sm-4">
          <input v-model="ticket" name="ticket" type="text" class="form-control" placeholder="Type a ticket">
          <button class="btn btn-xs btn-info" type="button" @click="lookup">Lookup</button>
          <br>
          <span>Better with debounce. It require some time to implement. Skipping at the moment.</span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Price</label>
        <div class="col-sm-3">
          <input v-model="price" name="price" class="form-control" type="number" placeholder="0" readonly>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Quantity</label>
        <div class="col-sm-3">
          <input name="quantity" type="number" class="form-control" placeholder="Quantity" value="1">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-10">
          <button type="submit" class="btn btn-primary" name="buy" value="buy">Buy</button>
          <button type="submit" class="btn btn-warning" name="sell" value="sell">Sell</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: ['token'],
  data() {
    return {
      ticket: '',
      price: 0,
      loading: false,
      error: false
    };
  },

  methods: {
    lookup() {
      if (! this.ticket) return;

      this.loading = true;

      axios.get('/stocks/lookup', {
          params: { ticket: this.ticket },
        })
        .then(({ data }) => {
          this.loading = false;
          this.error = false;
          this.price = data.price;
        })
        .catch(response => {
          this.loading = false;
          this.error = true;
        });
    }
  }
};
</script>
