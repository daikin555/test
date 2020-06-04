/* 基本設定*/
const stripe = Stripe(pk_test_0CIbuwQhZq7l4TOl5iUHout200buoz5CAY);
const elements = stripe.elements();

/* Stripe Elementsを使ったFormの各パーツをどんなデザインにしたいかを定義 */
const style = {
  base: {
    fontSize: '12px',
    color: "#32325d",
    border: "solid 1px ccc"
  }
};

/* フォームでdivタグになっている部分をStripe Elementsを使ってフォームに変換 */
const cardNumber = elements.create('cardNumber', {style:style});
cardNumber.mount('#cardNumber');
const cardCvc = elements.create('cardCvc', {style:style});
cardCvc.mount('#securityCode');
const cardExpiry = elements.create('cardExpiry', {style:style});
cardExpiry.mount('#expiration');
