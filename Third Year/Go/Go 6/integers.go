package mainimport "testing"
// add function to add two integers
func add(a, b int) int {
return a + b
}
// TestAdd function for unit testing
func TestAdd(t *testing.T) {
tests := []struct {
a, b, expected int
}{
{1, 2, 3},
{5, -3, 2},
{0, 0, 0},
}
for _, test := range tests {
result := add(test.a, test.b)
if result != test.expected {
t.Errorf("Expected %d, got %d", test.expected, result)
}
}
}
