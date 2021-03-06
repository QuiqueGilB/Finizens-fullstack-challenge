export default class OrderType {

    private static readonly BUY = "buy";
    private static readonly SELL = "sell";

    constructor(
        public readonly value: string
    ) {
        if (OrderType.BUY !== value && OrderType.SELL !== value) {
            throw new Error(value);
        }
    }

    public isBuy(): boolean {
        return OrderType.BUY === this.value;
    }

    public isSell(): boolean {
        return OrderType.SELL === this.value;
    }
}
