const { produce } = require('immer');

const setImmer = (t, i, e) =>
    produce(t, draft => {
        draft[i] = e;
    });

const set = (t, i, e) => {
    t[i] = e;
};

const t = Array.from({ length: 10 }, (_, k) => k);

console.log(t);

const t2 = setImmer(t, 0, 5);
console.log(t2);

const t3 = produce(t2, draft => set(draft, 0, 3));
console.log(t3);

const u = produce({}, _ =>
    Array.from({ length: 3 }, () => Array.from({ length: 3 }, () => 0))
);
u[0][0] = 5;
console.log(u);

const pair = { a: 1, t: Object.freeze([1, 2, 3]) };
console.log(pair);
const newPair = produce(pair, draft => {
    draft.t[0] = 5;
});
console.log(newPair);

// const range = (size, startAt = 0) =>
//     [...Array(size).keys()].map(i => i + startAt);

// const constant = cst => Array.from(range(7, 0), () => ({ from: cst, to: cst }));
// const increase = Array.from(range(7, 0), i => ({ from: i, to: i - 1 }));
// const decrease = Array.from(range(7, -1).reverse(), i => ({
//     from: i,
//     to: i + 1,
// }));
