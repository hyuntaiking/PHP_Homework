import Foundation
func listPrime() {
    for j in 0...9 {
        var i = 1
        while i <= 10 {
            let formatString = isPrime(number: j*10+i) ? "*%-3d" : " %-3d"
            print(String(format: formatString, j*10+i), terminator: "  ")
            i += 1
        }
        print()
    }
}
func isPrime(number: Int) -> Bool {
    // <1非質數
    if number <= 1 {
        return false
    }
    // 排除2、3的倍數，可少4/6的數字判斷
    if number > 2 && number%2==0 {
        return false
    }
    if number > 3 && number%3==0 {
        return false
    }
    if number == 2 || number == 3 {
        return true
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
