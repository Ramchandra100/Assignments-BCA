package main

import (
	"testing"
)

// BenchmarkSquare benchmarks the Square function
func BenchmarkSquare(b *testing.B) {
	for i := 0; i < b.N; i++ {
		Square(100) // Benchmark the square of 100
	}
}
