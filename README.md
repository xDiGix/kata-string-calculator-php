# String Calculator Kata

https://kata-log.rocks/string-calculator-kata

## TEST:

1. Step 1
   - [x] "" = 0
   - [x] "1" = 1
   - [x] "1,2" = 3
2. Step 2
   - [x] "3,5,1" = 9
3. Step 3
   - [x] "1\n2,3" = 6
4. Step 4
   - [x] "//;\n1;2" = 3 (format "//[delimiter]\n[numbers…]")
5. Step 5
   - [x] "-1" = exception "Negatives not allowed: -1"
6. Step 6
   - [x] "2 + 1001" = 2 (Numbers bigger than 1000 should be ignored)
7. Step 7
   - [x] "//[***]\n1***2***3" = 6 (format "//[delimiter]\n")
8. Step 8
   - [x] "//[*][%]\n1*2%3" = 6 (format //[delim1][delim2]\n)
9. Step 9
   - [x] "//[***][%%]\n3***3%%3" = 9 (handle multiple delimiters with length longer than one char)