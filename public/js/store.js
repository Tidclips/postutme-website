const productCards = document.querySelectorAll('.product-card');
const productModal = document.getElementById('product-modal');
const detailImage = document.getElementById('detail-image');
const detailTitle = document.getElementById('detail-title');
const detailDescription = document.getElementById('detail-description');
const detailColor = document.getElementById('detail-color');
const detailPrice = document.getElementById('detail-price');
const detailAdd = document.getElementById('detail-add');
const bagCount = document.querySelector('.bag-count');
let selectedProduct = null;
let cartCount = 2;

function formatPrice(value) {
    return `₦${Number(value).toLocaleString('en-NG')}`;
}

function updateBag() {
    bagCount.textContent = String(cartCount).padStart(2, '0');
}

function addToBag(product) {
    cartCount += 1;
    updateBag();
    product.querySelector('.quick-add')?.classList.add('added');
    const quickButton = product.querySelector('.quick-add');
    if (quickButton) {
        quickButton.textContent = 'Added ✓';
        setTimeout(() => {
            quickButton.textContent = 'Quick add +';
            quickButton.classList.remove('added');
        }, 1300);
    }
}

function openDetails(product) {
    selectedProduct = product;
    const image = product.querySelector('.shirt-photo');
    detailImage.src = image.src;
    detailImage.alt = image.alt;
    detailTitle.textContent = product.dataset.product;
    detailDescription.textContent = product.dataset.description;
    detailColor.textContent = `${product.dataset.color} / Limited drop`;
    detailPrice.textContent = formatPrice(product.dataset.price);
    productModal.classList.add('is-open');
    productModal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('modal-open');
    detailAdd.focus();
}

function closeDetails() {
    productModal.classList.remove('is-open');
    productModal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('modal-open');
}

productCards.forEach(product => {
    product.addEventListener('click', event => {
        if (event.target.closest('.quick-add')) {
            addToBag(product);
            return;
        }
        openDetails(product);
    });
});

document.querySelectorAll('[data-close-modal]').forEach(element => {
    element.addEventListener('click', closeDetails);
});

detailAdd.addEventListener('click', () => {
    if (!selectedProduct) return;
    addToBag(selectedProduct);
    closeDetails();
});

document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && productModal.classList.contains('is-open')) {
        closeDetails();
    }
});
