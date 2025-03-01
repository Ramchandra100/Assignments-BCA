#!/bin/bash

# Step 1: Create project directory
mkdir -p square-benchmark
cd square-benchmark

# Step 2: Initialize a Go module (this creates a go.mod file)
go mod init square-benchmark

# Step 3: Create square.go file
echo -e "package main\n\nimport \"fmt\"\n\n// Square function to calculate the square of a number\nfunc Square(n int) int {\n\treturn n * n\n}\n\nfunc main() {\n\t// Example usage of the Square function\n\tresult := Square(5)\n\tfmt.Println(\"Square of 5:\", result)\n}" > square.go

# Step 4: Create square_test.go file with benchmark
echo -e "package main\n\nimport (\n\t\"testing\"\n)\n\n// BenchmarkSquare benchmarks the Square function\nfunc BenchmarkSquare(b *testing.B) {\n\tfor i := 0; i < b.N; i++ {\n\t\tSquare(100) // Benchmark the square of 100\n\t}\n}" > square_test.go

# Step 5: Run the Go program (to verify the Square function works)
echo "Running the Go program..."
go run square.go

# Step 6: Run the benchmark
echo "Running the benchmark..."
go test -bench . -v

