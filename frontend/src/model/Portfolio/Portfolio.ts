import Allocation from "@/model/Portfolio/Allocation";

export default class Portfolio {

    constructor(
        readonly id: number,
        readonly allocations: Allocation[],
    ) {
    }

}