const state = {
    isLoading: false,
    compensation: {
        id: window.compensationId !== undefined ? window.compensationId : null,
        insuranceId: null,
        insuranceProvisionPeriodPlanMonth: window.periodPlanMonth !== undefined ? window.periodPlanMonth : null,
        insuranceProvisionPeriodPlanYear: window.periodPlanYear !== undefined ? window.periodPlanYear : null,
        insuranceProvisionPeriodPlanCompleted: false,
        totalProvisionPaid: 0,
        provisionFeedback: null,
        // sales compensation
        payoutRate: 100,
        salesCompensationFeedback: null,
        salesCompensationPeriodPlanMonth: window.periodPlanMonth !== undefined ? window.periodPlanMonth : null,
        salesCompensationPeriodPlanYear: window.periodPlanYear !== undefined ? window.periodPlanYear : null,
        salesCompensationPeriodPlanCompleted: false,
        totalSalesCompensation: 0,

        // each compensation has a unique sales order
        salesOrder: {
            id: null,
            people: null
        }
    }
}

export default state;