#!/bin/bash

# Step 1: Create project directory
mkdir -p subtract-example
cd subtract-example

# Step 2: Initialize a Go module (this creates a go.mod file)
go mod init subtract-example

# Step 3: Create subtract.go file
echo -e "package main\n\nimport \"fmt\"\n\n// Subtract function to subtract two integers\nfunc Subtract(a, b int) int {\n\treturn a - b\n}\n\nfunc main() {\n\t// Example usage of Subtract function\n\tresult := Subtract(10, 5)\n\tfmt.Println(\"Result of subtraction:\", result)\n}" > subtract.go

# Step 4: Create subtract_test.go file
echo -e "package main\n\nimport (\n\t\"fmt\"\n\t\"testing\"\n)\n\n// TestSubtract tests the Subtract function using table-driven tests\nfunc TestSubtract(t *testing.T) {\n\ttests := []struct {\n\t\ta, b\t\tint\n\t\texpected\tint\n\t}{\n\t\t{10, 5, 5},          // 10 - 5 = 5\n\t\t{20, 3, 17},         // 20 - 3 = 17\n\t\t{0, 0, 0},           // 0 - 0 = 0\n\t\t{-5, 5, -10},        // -5 - 5 = -10\n\t\t{100, 200, -100},    // 100 - 200 = -100\n\t}\n\n\tfor _, test := range tests {\n\t\tt.Run(fmt.Sprintf(\"%d-%d\", test.a, test.b), func(t *testing.T) {\n\t\t\tresult := Subtract(test.a, test.b)\n\t\t\tif result != test.expected {\n\t\t\t\tt.Errorf(\"expected %d, got %d\", test.expected, result)\n\t\t\t}\n\t\t})\n\t}\n}" > subtract_test.go

# Step 5: Run the Go program
echo "Running the Go program..."
go run subtract.go

# Step 6: Run the tests
echo "Running the tests..."
go test -v

