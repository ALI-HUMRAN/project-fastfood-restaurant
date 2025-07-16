let cart = [];

// Add item to cart by fetching its details from backend using ID
function addToCart(id) {
  fetch(`../api/get_item.php?id=${id}`)
    .then(res => {
      if (!res.ok) throw new Error('Failed to fetch item');
      return res.json();
    })
    .then(item => {
      const existing = cart.find(i => i.id === item.id);
      if (existing) {
        existing.qty++;
      } else {
        cart.push({ ...item, qty: 1 });
      }
      updateCartDisplay();
    })
    .catch(err => {
      console.error('Error fetching item:', err);
      alert('Failed to add item to cart.');
    });
}

// Update the cart view on the page
function updateCartDisplay() {
  const div = document.getElementById('cart-items');
  const totalSpan = document.getElementById('total');
  div.innerHTML = ''; // Clear previous display
  let total = 0;

  if (cart.length === 0) {
    div.textContent = 'Your cart is empty.';
    totalSpan.textContent = '0.00';
    return;
  }

  cart.forEach(item => {
    const line = document.createElement('div');
    line.textContent = `${item.name} x ${item.qty} - $${(item.price * item.qty).toFixed(2)}`;
    div.appendChild(line);
    total += item.price * item.qty;
  });

  totalSpan.textContent = total.toFixed(2);
}

// Place order by sending cart and address to backend
function placeOrder() {
  const address = document.getElementById('address').value.trim();
  if (!address) {
    alert('Please enter your delivery address.');
    return;
  }

  if (cart.length === 0) {
    alert('Your cart is empty.');
    return;
  }

  fetch('../api/place_order.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ cart, address })
  })
    .then(res => res.text())
    .then(msg => {
      alert(msg || 'Order placed!');
      cart = [];
      updateCartDisplay();
      document.getElementById('address').value = '';
    })
    .catch(err => {
      console.error('Error placing order:', err);
      alert('Failed to place order. Please try again.');
    });
}
