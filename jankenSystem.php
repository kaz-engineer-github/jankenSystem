<?php

//定数宣言
const STONE = 0;
const SCISSOR = 1;
const PAPER = 2;
const CHOOSE = "0: グー, 1: チョキ, 2: パー のいずれかから1つの数字を入力してください。";

const DRAW = 0;
const YOU_WIN = 2;
const YOU_LOSE = 1;

const HAND_TYPE = array(
    STONE => 'グー',
    SCISSOR => 'チョキ',
    PAPER => 'パー',
);


//バリデーション
function check($input) {
    if ($input === "") {
        echo "中身が空です。再度入力してください。";
        echo PHP_EOL;
        return false;
    }
    if ($input != STONE && $input != SCISSOR && $input != PAPER) {
        echo CHOOSE;
        echo PHP_EOL;
        return false;
    }
    return true;
}

//じゃんけん あなたの手
function yourChoise() {
    echo CHOOSE;
    echo PHP_EOL;
    $yourInput = trim(fgets(STDIN));
    $check = check($yourInput);
    if (!$check) {
        return yourChoise();
    }
    return $yourInput;
}

//じゃんけん コンピュータの手
function cpuChoise() {
    $jankenList = array(STONE, SCISSOR, PAPER);
    $result = array_rand($jankenList, 1);
    $cpuInput = $jankenList[$result];
    return $cpuInput;
}

//じゃんけん 勝ち負け判定
function judge($you, $cpu) {
    //(自分の手 - 相手の手 + 3) % 3
    $judge = ($you - $cpu + 3) % 3;
    return $judge;
}

//結果表示
function show($yourChoise, $cpuChoise, $result) {
    $yourChoise = HAND_TYPE[$yourChoise];
    $cpuChoise = HAND_TYPE[$cpuChoise];
    echo "あなた：" . "$yourChoise " . "相手：" . "$cpuChoise";
    echo PHP_EOL;
    if ($result === YOU_LOSE) {
        echo "あなたの負け";
        echo "CPUの勝利";
    }
    if ($result === YOU_WIN) {
        echo "あなたの勝利";
        echo "CPUの負け";
    }
}

function jankenSystem() {
    $yourChoise = yourChoise();
    $cpuChoise = cpuChoise();
    $result = judge($yourChoise, $cpuChoise);
    show($yourChoise, $cpuChoise, $result);
    if ($result == DRAW) {
        $draw = "あいこでしょ";
        echo $draw;
        echo PHP_EOL;
        return jankenSystem();
    }
}

echo "最初はグー";
echo PHP_EOL;
echo "じゃんけんぽん";
echo PHP_EOL;

jankenSystem();


?>