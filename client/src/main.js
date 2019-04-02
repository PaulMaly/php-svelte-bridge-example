import Cart from './Cart.html';
import Search from './Search.html';

const { products = [] } = window.__DATA__,
	targetCart = document.getElementById('cart'),
	targetSearch = document.getElementById('search');

/* only for hydration check */
const table1 = targetCart.querySelector('table');
const input1 = targetSearch.querySelector('input');
/* / only for hydration check */

const cart = new Cart({
	target: targetCart,
	data: { products },
	hydrate: true
});

const search = new Search({
	target: targetSearch,
	data: { products },
	hydrate: true
});

/* only for hydration check */
const table2 = targetCart.querySelector('table');
const input2 = targetSearch.querySelector('input');

console.log('Is component Cart hydrated?', table1 === table2, table1, table2);
console.log('Is component Search hydrated?', input1 === input2, input1, input2);
/* / only for hydration check */

export {
	cart,
	search
};