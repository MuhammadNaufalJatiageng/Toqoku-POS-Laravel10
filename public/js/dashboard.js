const qtyPlus = document.querySelectorAll(".plus");
const qtyMinus = document.querySelectorAll(".min");
let qty = document.querySelectorAll('.quantity');
let plusForm = document.querySelectorAll('.plus-form');
let minForm = document.querySelectorAll('.min-form');
let onchangeForm = document.querySelectorAll('.onchange-form');
const prices = document.querySelectorAll('.product-price');
const subtotal = document.querySelectorAll('.subtotal');
const totalItem = document.querySelectorAll('.total-item');
const product = document.querySelectorAll('.product-name');
const cards = document.querySelectorAll('.card');
const cardForms = document.querySelectorAll('.add-to-cart');
const prosesBtn = document.querySelector('#co');
const delBtn = document.querySelectorAll('.del-btn');
const delCart = document.querySelectorAll('.del-cart');
const onChange = document.querySelectorAll('.onchange');
let totalPrice = document.querySelectorAll('.total-price');

// Format 
const rupiah = (number)=>{
    return new Intl.NumberFormat("id-ID").format(number);
}
// end Format

product.forEach((item, index) => {
    subtotal.innerHTML = getSubtotal(index);
});

// Add To Cart
cards.forEach((item, index) => {
    item.addEventListener('click', () => {
        cardForms[index].submit();
    });
});

getTotal();

qty.forEach((item, index )=> {
    item.addEventListener('change', () => {
        onChange[index].value = item.value;
        onchangeForm[index].submit();
        getTotal(index);
        getSubtotal();
    });
})

// When + button click
qtyPlus.forEach((item , index) => {
    item.addEventListener('click', (e) => {
        e.preventDefault();
        plusForm[index].submit();
        getSubtotal(index);
        getTotal();
    });
})

// When - button click  
qtyMinus.forEach((item , index) => {
    item.addEventListener('click', (e) => {
        e.preventDefault();
        minForm[index].submit();
        getSubtotal(index);
        getTotal();
    });
})

function getSubtotal(index) {
    const price = parseTheRupiah(prices[index].innerHTML);
    const quantity = parseInt(qty[index].value);

    let totalPrice = price * quantity;
    totalItem[index].value = totalPrice;
    subtotal[index].innerHTML = rupiah(totalPrice);
}

function getTotal(){
    const arr = [];
    subtotal.forEach((item) => {
        arr.push(parseTheRupiah(item.innerHTML));
    })

    let sum = arr.reduce((accumulator, object) => {
        return accumulator + object;
    }, 0);

    let discount = document.querySelector('#discountValue').value;
    // console.log(discount);
    discount = parseTheRupiah(discount);

    if (isNaN(discount)) {
        discount = 0;
    }
    sum = sum - discount;

    totalPrice[0].innerHTML = rupiah(sum);
    totalPrice[1].innerHTML = rupiah(sum);
    getChange()
}

// Delete product from cart

delBtn.forEach((item, index) => {
    item.addEventListener('click', () => {
        delCart[index].submit();
    })
});

// Parse from rupiah to integer
function parseTheRupiah(value){
    newValue = value.replaceAll('.',"");
    const total = parseInt(newValue);
    return total;
}

function submitForm(params) {
    document.querySelector(params).submit();
}


function discount(params) {
    document.querySelector('#discount').value = 0;
    document.querySelector('#discountValue').value = 0;
    getTotal();

    let nominal = 0;
    let total = parseTheRupiah(totalPrice[0].innerHTML);
    if(params == '2%')
    {
        nominal = String(( total * 2)/100);
    }
    if(params == '5%')
    {
        nominal = String(( total * 5)/100);
    }
    if(params == '10%')
    {
        nominal = String(( total * 10)/100);
    }
    if(params == '5k')
    {
        nominal = "5.000";
    }
    if(params == '10k')
    {
        nominal = "10.000";
    }

    console.log(nominal);
    document.querySelector('#discount').value = nominal;
    document.querySelector('#discountValue').value = parseTheRupiah(nominal);
    getTotal();
}

function getInputChange(params) {
    document.querySelector('#total-payment').value = 0;

    let nominal = 0;

    if(params == '10k')
    {
        nominal = "10.000";
    }
    if(params == '20k')
    {
        nominal = "20.000";
    }
    if(params == '50k')
    {
        nominal = "50.000";
    }
    if(params == '100k')
    {
        nominal = "100.000";
    }

    document.querySelector('#total-payment').value = nominal;
    getChange();
}

function getChange() {
    let total = parseTheRupiah(document.querySelectorAll('.total-price')[0].innerHTML);
    let totalPayment = parseTheRupiah(document.querySelector('#total-payment').value);

    if (isNaN(totalPayment)) {
        document.querySelector('.total-change').innerHTML = '0';
    }
    else{
        const change = totalPayment - total;
    
        document.querySelector('.total-change').innerHTML = rupiah(change);
    }
    
}





