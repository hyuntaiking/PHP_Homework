import Foundation
func listPrime(row: Int, col: Int) {
    for j in 0...row-1 {
        for i in 1...col {
            let formatString = isPrime(number: j*10+i) ? "%3d*" : "%3d "
            print(String(format: formatString, j*10+i), terminator: "  ")
        }
        print()
    }
}
func isPrime(number: Int) -> Bool {
    // <1非質數
    if number <= 1 {
        return false
    }
    if number <= 3 {
        return true
    }
    // 排除2、3的倍數，可少4/6的數字判斷
    if number > 2 && number%2==0 {
        return false
    }
    if number > 3 && number%3==0 {
        return false
    }
    
    var result = true
    // TODO 只要除質數即可(未完成...)
    for i in 2...Int(sqrt(Double(number))) {
        if (number % i == 0) {
            result = false
            break
        }
    }
    return result
}
