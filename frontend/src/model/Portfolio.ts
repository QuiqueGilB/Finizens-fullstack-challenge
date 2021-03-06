import Allocation from "@/model/Allocation";

export default class Portfolio {

    constructor(
        readonly id: number,
        readonly allocations: Allocation[],
    ) {
    }

}