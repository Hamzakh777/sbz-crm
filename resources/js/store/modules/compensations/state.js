const state = {
    isLoading: false,
    compensation: {
        id: window.compensationId !== undefined ? window.compensationId : null,
        insuranceId: null,
        insuranceProvisoinPeriodPlanMonth: null,
        insuranceProvisoinPeriodPlanYear: null,
        insuranceProvisionPeriodPlanCompleted: false,
        totalProvisionPaid: 0,
        provisionFeedback: null,

        // sales compensation
        payoutRate: 100,
        salesCompensationFeedback: null,

        // each compensation has a unique sales order
        salesOrder: {
            id: null,
            people: null
        }
    }
}

export default state;