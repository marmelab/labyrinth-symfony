const express = require('express');
const bodyParser = require('body-parser');

const { createGame, handleEvent } = require('../src/game');
const { EVENT } = require('../src/constants');

const app = express();
const PORT = 3000;

app.use(bodyParser.json());

app.get('/', (req, res) =>
    res.status(200).json({ msg: 'Welcome to Labyrinth API server' }),
);

app.get('/createGame', (req, res) => res.status(200).json(createGame()));

app.post('/rotate', (req, res) => {
    const game = req.body;
    return res.status(200).json(handleEvent(game, EVENT.ROTATE));
});

app.get('/game', (req, res) => {
    const game = {
        board: [
            [
                { type: '┗', x: 0, y: 0, direction: 0, target: null, id: 1 },
                { type: '┻', x: 0, y: 1, direction: 0, target: 22, id: 49 },
                { type: '┻', x: 0, y: 2, direction: 1, target: 2, id: 5 },
                { type: '┃', x: 0, y: 3, direction: 0, target: null, id: 17 },
                { type: '┻', x: 0, y: 4, direction: 1, target: 6, id: 9 },
                { type: '┃', x: 0, y: 5, direction: 3, target: null, id: 26 },
                { type: '┗', x: 0, y: 6, direction: 1, target: null, id: 13 },
            ],
            [
                { type: '┻', x: 1, y: 0, direction: 0, target: 20, id: 47 },
                { type: '┃', x: 1, y: 1, direction: 0, target: null, id: 22 },
                { type: '┃', x: 1, y: 2, direction: 2, target: null, id: 20 },
                { type: '┃', x: 1, y: 3, direction: 0, target: null, id: 27 },
                { type: '┃', x: 1, y: 4, direction: 0, target: null, id: 23 },
                { type: '┃', x: 1, y: 5, direction: 1, target: null, id: 28 },
                { type: '┗', x: 1, y: 6, direction: 0, target: null, id: 32 },
            ],
            [
                { type: '┻', x: 2, y: 0, direction: 0, target: 0, id: 2 },
                { type: '┃', x: 2, y: 1, direction: 2, target: null, id: 21 },
                { type: '┻', x: 2, y: 2, direction: 0, target: 3, id: 6 },
                { type: '┗', x: 2, y: 3, direction: 1, target: null, id: 33 },
                { type: '┻', x: 2, y: 4, direction: 1, target: 7, id: 10 },
                { type: '┃', x: 2, y: 5, direction: 1, target: null, id: 19 },
                { type: '┻', x: 2, y: 6, direction: 2, target: 10, id: 14 },
            ],
            [
                { type: '┗', x: 3, y: 0, direction: 1, target: 17, id: 44 },
                { type: '┻', x: 3, y: 1, direction: 1, target: 21, id: 48 },
                { type: '┗', x: 3, y: 2, direction: 3, target: null, id: 35 },
                { type: '┗', x: 3, y: 3, direction: 3, target: 15, id: 42 },
                { type: '┗', x: 3, y: 4, direction: 1, target: null, id: 37 },
                { type: '┃', x: 3, y: 5, direction: 1, target: null, id: 25 },
                { type: '┃', x: 3, y: 6, direction: 3, target: null, id: 24 },
            ],
            [
                { type: '┻', x: 4, y: 0, direction: 0, target: 1, id: 3 },
                { type: '┗', x: 4, y: 1, direction: 0, target: null, id: 34 },
                { type: '┻', x: 4, y: 2, direction: 3, target: 4, id: 7 },
                { type: '┗', x: 4, y: 3, direction: 2, target: null, id: 30 },
                { type: '┻', x: 4, y: 4, direction: 2, target: 8, id: 11 },
                { type: '┻', x: 4, y: 5, direction: 3, target: 19, id: 46 },
                { type: '┻', x: 4, y: 6, direction: 2, target: 11, id: 15 },
            ],
            [
                { type: '┗', x: 5, y: 0, direction: 2, target: null, id: 38 },
                { type: '┃', x: 5, y: 1, direction: 1, target: null, id: 18 },
                { type: '┗', x: 5, y: 2, direction: 0, target: 13, id: 40 },
                { type: '┗', x: 5, y: 3, direction: 0, target: 14, id: 41 },
                { type: '┗', x: 5, y: 4, direction: 2, target: 16, id: 43 },
                { type: '┃', x: 5, y: 5, direction: 1, target: null, id: 29 },
                { type: '┻', x: 5, y: 6, direction: 1, target: 23, id: 50 },
            ],
            [
                { type: '┗', x: 6, y: 0, direction: 3, target: null, id: 4 },
                { type: '┗', x: 6, y: 1, direction: 2, target: 12, id: 39 },
                { type: '┻', x: 6, y: 2, direction: 3, target: 5, id: 8 },
                { type: '┗', x: 6, y: 3, direction: 0, target: null, id: 36 },
                { type: '┻', x: 6, y: 4, direction: 3, target: 9, id: 12 },
                { type: '┗', x: 6, y: 5, direction: 2, target: null, id: 31 },
                { type: '┗', x: 6, y: 6, direction: 2, target: null, id: 16 },
            ],
        ],
        players: [{ color: 'green', x: 0, y: 0, targetCards: [{ target: 0 }] }],
        scores: [0],
        remainingPathCard: {
            type: '┻',
            x: 1,
            y: -1,
            direction: 0,
            target: 18,
            id: 45,
        },
        currentIndexOfPathCardInsertionPosition: 0,
        currentPlayerIndex: 0,
        state: 0,
    };

    return res.status(200).json(game);
});

app.listen(PORT, () => console.log(`Example app listening on port ${PORT}!`));
