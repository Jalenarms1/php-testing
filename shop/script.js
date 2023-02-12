const addToCartBtns = document.querySelectorAll(".add-to-cart-button");
const cartItemsWrap = document.querySelector('.cart-items');
const removeFromCart = document.querySelectorAll('.delete-item');
const submitOrderBtn = document.querySelector('.submit-order-button')

if(addToCartBtns) {
    addToCartBtns.forEach(button => {
        button.addEventListener("click", function() {
            document.querySelector('#paypal-button-container').classList.remove('hide')
            console.log("logged");
            // Retrieve the product information
            var product = {
              id: this.parentNode.querySelector("#item-id").value,
              name: this.parentNode.querySelector("#item-name").value,
              image: this.parentNode.querySelector("#item-image").value,
              price: this.parentNode.querySelector("#item-price").value,
              quantity: 1,
              total: this.price
            };
          
            // Check if the item already exists in the cart
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            let item = cart.find(item => item.id === product.id);
            if (item) {
              item.quantity++;
              item.total = item.price * item.quantity;
            } else {
              product.quantity = 1;
              product.total = product.price * product.quantity;
              cart.push(product);
            }
            localStorage.setItem("cart", JSON.stringify(cart));
            updateDisplay();
            cartTotal();
        });
    
    })
      

}
if(removeFromCart) {
    cartItemsWrap.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-item')) {
          let productId = e.target.getAttribute('id');
          let cart = JSON.parse(localStorage.getItem('cart')) || [];
          
          // Find the product with the same id in the cart and remove it
          cart = cart.filter(function(product) {
            return product.id !== productId;
          });
          
          localStorage.setItem('cart', JSON.stringify(cart));
          if(cart.length === 0 ) {
            location.reload();
          }
          // Update the cart display
          updateDisplay()
          cartTotal();
        } else if (e.target.classList.contains('inc-quantity')) {
            let cart = JSON.parse(localStorage.getItem('cart'));

            cart.forEach(item => {
                if(item.id === e.target.id) {
                    item.quantity++;
                    item.total = item.quantity * item.price;
                }
            })

            localStorage.setItem('cart', JSON.stringify(cart))
            updateDisplay();
            cartTotal();

        } else if (e.target.classList.contains('dec-quantity')) {
            let cart = JSON.parse(localStorage.getItem('cart'));

            cart.forEach(item => {
                if(item.id === e.target.id) {
                    if(item.quantity === 1) {
                        
                        return;
                    }
                    item.quantity--;
                    item.total = item.quantity * item.price;

                    return;
                }
            })

            localStorage.setItem('cart', JSON.stringify(cart))
            updateDisplay();
            cartTotal();

        }
    });
      
      
      
}




const displayCartItems = () => {
    let cart = JSON.parse(localStorage.getItem('cart'));

  // Check if cart is not empty
    if (cart.length > 0) {
        // Loop through each item in the cart
        cart.forEach(function(product) {
        // Create a new div for each cart item
            const item = document.createElement('div');
            item.classList.add('cart-item');

            const itemImg = document.createElement('img');
            itemImg.src = product.image;
            itemImg.alt = product.name;
            item.appendChild(itemImg);

            const itemContent = document.createElement('div');
            itemContent.classList.add('item-content');
            item.appendChild(itemContent);

            const productName = document.createElement('h3');
            productName.classList.add('product-name');
            productName.innerText = product.name;
            itemContent.appendChild(productName);

            const quantityWrap = document.createElement('div');
            quantityWrap.classList.add('quantity-wrap')
            const quantity = document.createElement('p');
            quantity.innerText = `${product.quantity}`;
            const addSign = document.createElement('button');
            addSign.id = product.id;
            addSign.classList.add('inc-quantity')
            addSign.textContent = '+';
            const subtractSign = document.createElement('button');
            subtractSign.id = product.id;

            subtractSign.classList.add('dec-quantity')

            subtractSign.textContent = '-';
            quantityWrap.appendChild(quantity);
            quantityWrap.appendChild(addSign);
            quantityWrap.appendChild(subtractSign);
            itemContent.appendChild(quantityWrap);

            const total = document.createElement('p');
            total.innerText = `Total: $${product.total.toFixed(2)}`;
            itemContent.appendChild(total);

            const deleteButton = document.createElement('button');
            deleteButton.classList.add('delete-item');
            deleteButton.id = product.id;
            deleteButton.innerText = "Remove";
            itemContent.appendChild(deleteButton);

            cartItemsWrap.appendChild(item);
        });
    }
}

const updateDisplay = () => {
    cartItemsWrap.innerHTML = '';
    displayCartItems();
    cartTotal();
}

const cartTotal = () => {
    let cart = JSON.parse(localStorage.getItem('cart'));
    let totalPrice = cart.reduce(function(accumulator, currentValue) {
        return accumulator + currentValue.total;
    }, 0);
    let formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    });
    document.getElementById("cart-total").textContent = `Total: ${formatter.format(totalPrice)}`
    return totalPrice
}

const submitOrder = () => {
    let cart = JSON.parse(localStorage.getItem('cart'));
    let userId = document.getElementById('user-id')
    let total = cart.reduce(function(accumulator, currentValue) {
        return accumulator + currentValue.total;
    }, 0);
    let ob = {
        total: parseFloat(total),
        userId: parseInt(userId.value),
        products: cart.map(item => {
            return {id: item.id, quantity: item.quantity}
        })
    };
    console.log(ob);
    // id, total, userId, products
    fetch("submit.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json; charset=utf-8"
        },
        body: JSON.stringify(ob)
      })
        .then(response => response.text())
        .then(data => console.log(data));
    localStorage.setItem('cart', JSON.stringify([]))
    updateDisplay();
    cartTotal();
}

let cart = JSON.parse(localStorage.getItem('cart'));
let userId = document.getElementById('user-id')
let total = cart.reduce(function(accumulator, currentValue) {
    return accumulator + currentValue.total;
}, 0);
submitOrderBtn.addEventListener('click', submitOrder)

if(cart && cart.length > 0) {
  document.querySelector('#paypal-button-container').classList.remove('hide')
} else {
  document.querySelector('#paypal-button-container').classList.add('hide')
}

const submitReceipt = (transactionId, total, payer_email, timestamp) => {
  fetch("submit-receipt.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8"
        },
        body: JSON.stringify({
          transactionId,
          total,
          payer_email,
          timestamp
        })
      })
      .then(response => response.text())
      .then(data => console.log(data));
    }
    
    cartTotal();
    displayCartItems()
    paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: cartTotal() // Can also reference a variable or function
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData);
            const transaction = orderData.purchase_units[0].payments.captures[0];
            submitOrder();
            // submitReceipt(orderData.id, orderData.purchase_units[0].amount.value, orderData.payer.email_address, orderData.create_time);
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
        }
    }).render('#paypal-button-container');