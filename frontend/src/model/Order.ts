export default class Order {
    constructor(
        readonly id: number,
        readonly portfolioId: number,
        readonly allocationId: number,
        readonly shares: number
    ) {
    }
}