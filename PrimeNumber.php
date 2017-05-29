<?php
/*----------------------------------------------------------------------------*/
/* 程式名稱: 列出質數(PHP版)                                                  */
/* 程式說明: 列出10列*10行的數字，質數以黃色標示                              */
/* 傳回參數:                                                                  */
/* 使用說明: 可動態調整最大數($maxNum)和行數($col)                            */
/*----------------------------------------------------------------------------*/
$maxNum = 100;
$col = 10;
echo '<table border="1" width="100%">';
for ($i=1; $i<=$maxNum; $i++) {
    if ($i % $col == 1) echo '<tr>';
    if (isPrimeNumber($i)) {
        echo "<td bgcolor='yellow'>{$i}</td>";
    } else {
        echo "<td>{$i}</td>";
    }
    if ($i % $col == 0) echo '</tr>';
}
echo '</table>';
/*----------------------------------------------------------------------------*/
/* 程式名稱: isPrimeNumber()                                                  */
/* 程式說明: 判斷是否為質數                                                   */
/* 傳回參數: true、false                                                      */
/* 使用說明:                                                                  */
/*----------------------------------------------------------------------------*/
function isPrimeNumber($number) {
    // <1非質數
    if ($number <= 1) {
        return false;
    }
    // 排除2、3的倍數，可少4/6的數字判斷
    if ($number > 2 && $number%2==0) {
        return false;
    }
    if ($number > 3 && $number%3==0) {
        return false;
    }
    $result = true;
    // TODO 只要除質數即可(未完成...)
    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i == 0) {
            $result = false;
            break;
        }
    }
    return $result;
}