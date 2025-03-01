package main

import (
	"fmt"
	"testing"
)

// TestSubtract tests the Subtract function using table-driven tests
func TestSubtract(t *testing.T) {
	tests := []struct {
		a, b		int
		expected	int
	}{
		{10, 5, 5},          // 10 - 5 = 5
		{20, 3, 17},         // 20 - 3 = 17
		{0, 0, 0},           // 0 - 0 = 0
		{-5, 5, -10},        // -5 - 5 = -10
		{100, 200, -100},    // 100 - 200 = -100
	}

	for _, test := range tests {
		t.Run(fmt.Sprintf("%d-%d", test.a, test.b), func(t *testing.T) {
			result := Subtract(test.a, test.b)
			if result != test.expected {
				t.Errorf("expected %d, got %d", test.expected, result)
			}
		})
	}
}
