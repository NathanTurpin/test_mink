export const priceMixin = {
  methods: {
    calculatePriceWithVAT(price, tva) {
      const priceWithVAT = price * (1 + tva / 100);
      return `${priceWithVAT.toFixed(2)}€ TTC`;
    },
  },
};
