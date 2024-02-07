let total = document.querySelectorAll('.total');
let subtotal = document.querySelectorAll('.subtotal');
const getDiscount = document.querySelector('.discount');
    
// Format 
const rupiah = (number)=>{
return new Intl.NumberFormat("id-ID").format(number);
}

getSubtotal();
totalAfterDisount();

function getSubtotal(){
    const arr = [];
    total.forEach((item) => {
        arr.push(parseTheRupiah(item.innerHTML));
    })

    const sum = arr.reduce((accumulator, object) => {
        return accumulator + object;
    }, 0);

    subtotal[0].innerHTML = rupiah(sum);
    subtotal[1].innerHTML = rupiah(sum);
}

function totalAfterDisount() {
    const getSubtotal = parseTheRupiah(subtotal[0].innerHTML); 
    const discount = parseTheRupiah(getDiscount.innerHTML); 
    const total = getSubtotal - discount;

    document.querySelector('.total-payment').innerHTML = rupiah(total);
}

function parseTheRupiah(value){
    value = value.replace('.',"");
    const total = parseInt(value);
    return total;
}




