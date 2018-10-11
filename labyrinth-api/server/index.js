const express = require('express');
const bodyParser = require('body-parser');
const { produce } = require('immer');
const { STATE } = require('../src/constants');

const {
    createGame, rotateRemainingPathCard, insertRemainingPathCard, moveCurrentPlayerTo, toNextPlayerTurn,
    toEndState, toMoveState, toInsertState
} = require('../src/game');

const app = express();
const PORT = 3000;

app.use(bodyParser.json());

app.get('/', (req, res) =>
    res.status(200).json({ msg: 'Welcome to Labyrinth API server' }),
);

app.get('/createGame', (req, res) => res.status(200).json(createGame()));

app.post('/rotateRemainingPathCard', (req, res) => {
    const game = req.body;
    console.log("/rotateRemainingPathCard dir:" + game.remainingPathCard.direction);

    let newGame = rotateRemainingPathCard(game);
    newGame = toInsertState(newGame);
    return res.status(200).json(newGame);
});

app.post('/insertRemainingPathCard', (req, res) => {
    const game = req.body;
    console.log("/insertRemainingPathCard x:" + game.remainingPathCard.x + ' y:' + game.remainingPathCard.y + ' state:' + game.state);

    let newGame = game.state === STATE.TO_INSERT ? insertRemainingPathCard(game) : game;
    newGame = toMoveState(newGame);
    return res.status(200).json(newGame);
});

app.post('/movePlayerTo/:x/:y', (req, res) => {
    const game = req.body;
    const x = parseInt(req.params.x, 10);
    const y = parseInt(req.params.y, 10);

    console.log("/movePlayerTo x:" + x + ' y:' + y);
    let newGame = game.state === STATE.TO_MOVE ? moveCurrentPlayerTo(game, x, y) : game;
    newGame = toNextPlayerTurn(newGame);
    newGame = toInsertState(newGame);
    return res.status(200).json(newGame);
});

app.listen(PORT, () => console.log(`Example app listening on port ${PORT}!`));
